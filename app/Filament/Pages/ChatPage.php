<?php 

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use App\Models\Rfq;
use App\Models\RfqItem;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Models\MessageAttachment;
use App\Models\CustomSynthesisSubmission;
use Livewire\WithFileUploads;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class ChatPage extends Page
{
    use WithFileUploads;

    protected static string $view = 'filament.pages.chat-page';
    protected static ?string $title = 'Threads';
 
    public $messages = [];
    public $messageText = '';
    public $attachment = null;
    public $rfqId;
    public $rfqStatus = 'open';
    public $rfqData = [];
    public $conversationId;
    public $rfq_items = [];
    public $adminUserId = null;
    public $currentUserId = null;
    public $lastMessageId = 0; 
    public $isPolling = true;
    public $userTimezone = null;

    public function mount(): void
    {
        $this->rfqId = request()->query('rfqId');

        if (!$this->rfqId) {
            abort(404, 'RFQ ID not found in query string!');
        }

        $this->adminUserId = Auth::id();
        $this->userTimezone = Auth::user()->timezone ?? 'Europe/Helsinki';

        $this->currentUserId = Rfq::where('id', $this->rfqId)->value('user_id');
        
        if (!$this->adminUserId || !$this->currentUserId) {
            abort(404, 'Something went wrong!');
        }

        $this->rfqData = Rfq::where('id', $this->rfqId)->first();
        $this->rfqStatus = $this->rfqData ? $this->rfqData->status : null;

        $this->findOrCreateConversation();
        $this->loadMessages();
        $this->loadRfqItems();
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin/rfqs' => 'RFQs',
            '#' => 'Thread',
        ];
    }

    public static function getSlug(): string
    {
        return 'thread';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    
    public function findOrCreateConversation()
    {
        $adminUserId = $this->adminUserId; 
        $currentUserId = $this->currentUserId;

        $conversation = Conversation::where('rfq_id', $this->rfqId)
            ->where(function ($query) use ($currentUserId, $adminUserId) {
                $query->where(function ($q) use ($currentUserId, $adminUserId) {
                    $q->where('user_one_id', $currentUserId)
                      ->where('user_two_id', $adminUserId);
                })->orWhere(function ($q) use ($currentUserId, $adminUserId) {
                    $q->where('user_one_id', $adminUserId)
                      ->where('user_two_id', $currentUserId);
                });
            })
            ->first();
        
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $currentUserId,
                'user_two_id' => $adminUserId,
                'rfq_id' => $this->rfqId,
            ]);
        }
        
        $this->conversationId = $conversation->id;
    }
    
    public function loadMessages()
    {
        $messages = Message::with(['messageAttachments', 'conversation'])
            ->where('rfq_id', $this->rfqId)
            ->where('conversation_id', $this->conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        $this->messages = $messages->map(function ($message) {
            return [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at
                ? $message->created_at->setTimezone($this->userTimezone)->format('Y-m-d H:i:s')
                : null,
                'rfq_id' => $message->rfq_id,
                'conversation_id' => $message->conversation_id,
                'has_attachment' => $message->has_attachment,
                'is_admin' => $this->isAdminMessage($message->sender_id),
                'attachments' => $message->messageAttachments->map(function ($att) {
                    return [
                        'file_name' => $att->file_name,
                        'file_url' => $att->file_url,
                        'file_type' => $att->file_type,
                    ];
                })->toArray()
            ];
        })->toArray();

        if (!empty($this->messages)) {
            $this->lastMessageId = collect($this->messages)->max('id');
        }
    }

    public function checkForNewMessages()
    {
        if (!$this->isPolling) {
            return;
        }

        $newMessages = Message::with(['messageAttachments', 'conversation'])
            ->where('rfq_id', $this->rfqId)
            ->where('conversation_id', $this->conversationId)
            ->where('id', '>', $this->lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($newMessages->isNotEmpty()) {
            $formattedNewMessages = $newMessages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'created_at' => $message->created_at
                    ? $message->created_at->setTimezone($this->userTimezone)->format('Y-m-d H:i:s')
                    : null,
                    'rfq_id' => $message->rfq_id,
                    'conversation_id' => $message->conversation_id,
                    'has_attachment' => $message->has_attachment,
                    'is_admin' => $this->isAdminMessage($message->sender_id),
                    'attachments' => $message->messageAttachments->map(function ($att) {
                        return [
                            'file_name' => $att->file_name,
                            'file_url' => $att->file_url,
                            'file_type' => $att->file_type,
                        ];
                    })->toArray()
                ];
            })->toArray();

            $this->messages = array_merge($this->messages, $formattedNewMessages);
            
            $this->lastMessageId = collect($newMessages)->max('id');
            
            $this->dispatch('new-messages-received', count($formattedNewMessages));
        }
    }

    public function togglePolling($state = null)
    {
        $this->isPolling = $state ?? !$this->isPolling;
    }

    public function userStartedTyping()
    {
        $this->togglePolling(false);
        $this->dispatch('resume-polling-after-delay');
    }

    public function resumePolling()
    {
        $this->togglePolling(true);
    }
    
    private function isAdminMessage($sender_id)
    {  
        return $sender_id == $this->adminUserId ? 1 : 0;
    }
    
    public function loadRfqItems()
    {
        if ($this->rfqData && $this->rfqData->type === 'custom') {
            $this->rfq_items = CustomSynthesisSubmission::with('customProduct')
                ->where('rfq_id', $this->rfqId)
                ->first();
        } else {
            $this->rfq_items = RfqItem::with('product')
                ->where('rfq_id', $this->rfqId)
                ->get();
        }
        
    }
    
    public function sendMessage()
    {
        if (empty(trim($this->messageText)) && !$this->attachment) {
            Notification::make()
                ->title('Error')
                ->body('Please enter a message or select a file.')
                ->danger()
                ->send();
            return;
        }

        try {
            DB::transaction(function () {
                $hasAttachment = $this->attachment ? true : false;
                
                $message = Message::create([
                    'sender_id' => $this->adminUserId,
                    'rfq_id' => $this->rfqId,
                    'conversation_id' => $this->conversationId,
                    'message' => trim($this->messageText) ?: '',
                    'has_attachment' => $hasAttachment,
                ]);

                if ($hasAttachment) {
                    $path = $this->attachment->store('message-attachments', 'public');
                    $fileUrl = Storage::url($path);
                    
                    MessageAttachment::create([
                        'message_id' => $message->id,
                        'file_type' => $this->attachment->getMimeType(),
                        'file_name' => $this->attachment->getClientOriginalName(),
                        'file_url' => $fileUrl,
                    ]);
                }

                $this->lastMessageId = $message->id;
            });

            $this->reset(['messageText', 'attachment']);
            $this->loadMessages();
            $this->dispatch('message-sent');
            
            $this->resumePolling();
            
            Notification::make()
                ->title('Message sent!')
                ->success()
                ->send();

        } catch (Exception $e) {
            Notification::make()
                ->title('An error occurred')
                ->body('Your message could not be sent. Please try again. Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function removeAttachment()
    {
        $this->attachment = null;
    }
    
    public function refreshMessages()
    {
        $this->loadMessages();
    }
    
    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'max:10240',
        ]);
    }
}