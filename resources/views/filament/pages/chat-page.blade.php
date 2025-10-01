<x-filament-panels::page>
    <section class="py-5">
        <div class="chat-row">
            <div class="chat-row__left">
                <div class="chat-box">
                    <div class="chat-messages" id="chat-messages-container">
                        @if(count($messages) > 0)
                            @foreach($messages as $message)
                                <div class="chat-time text-center">
                                    {{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}
                                </div>
                                @if(!$message['is_admin'])
                                    <div class="chat-bubble-left">
                                        @if(!empty($message['message']))
                                            {{ $message['message'] }}
                                        @endif
                                        
                                        @if(isset($message['attachments']) && count($message['attachments']) > 0)
                                            @foreach($message['attachments'] as $attach)
                                                <div class="mt-2">
                                                    @if(str_starts_with($attach['file_type'], 'image/'))
                                                        <img src="{{ $attach['file_url'] }}" 
                                                             alt="{{ $attach['file_name'] }}" 
                                                             class="max-w-full h-auto rounded"
                                                             style="max-width: 100px;">
                                                    @else
                                                        <a href="{{ $attach['file_url'] }}" 
                                                           download="{{ $attach['file_name'] }}" 
                                                           class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                                                            <img src="{{ asset('images/icons/attachment.svg') }}" class="w-4 h-4">
                                                            <span>{{ $attach['file_name'] }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @else
                                    <div class="chat-bubble-right">
                                        @if(!empty($message['message']))
                                            {{ $message['message'] }}
                                        @endif
                                        
                                        @if(isset($message['attachments']) && count($message['attachments']) > 0)
                                            @foreach($message['attachments'] as $attach)
                                                <div class="mt-2">
                                                    @if(str_starts_with($attach['file_type'], 'image/'))
                                                        <img src="{{ $attach['file_url'] }}" 
                                                             alt="{{ $attach['file_name'] }}" 
                                                             class="max-w-full h-auto rounded"
                                                             style="max-width: 100px;">
                                                    @else
                                                        <a href="{{ $attach['file_url'] }}" 
                                                           download="{{ $attach['file_name'] }}" 
                                                           class="text-white hover:text-gray-200 flex items-center space-x-1">
                                                            <img src="{{ asset('images/icons/attachment.svg') }}" class="w-4 h-4">
                                                            <span>{{ $attach['file_name'] }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    
                    @if($attachment)
                        <div class="mb-3" style="display: inline-block;">
                            <div style="position: relative; display: inline-block;">
                                 @if(is_object($attachment) && method_exists($attachment, 'temporaryUrl'))
                                    @php
                                        $mimeType = $attachment->getMimeType();
                                    @endphp
                                    @if(str_starts_with($mimeType, 'image/'))
                                        <img src="{{ $attachment->temporaryUrl() }}" 
                                             alt="Preview" 
                                             class="rounded"
                                             style="max-width: 200px; max-height: 200px; object-fit: cover; border: 2px solid #dee2e6; display: block;">
                                    @else
                                        <div class="d-flex align-items-center gap-2 p-3 bg-light rounded" style="border: 2px solid #dee2e6;">
                                            <img src="{{ asset('images/icons/attachment.svg') }}" style="width: 20px; height: 20px;">
                                            <span class="text-muted">{{ $attachment->getClientOriginalName() }}</span>
                                        </div>
                                    @endif
                                @endif
                                
                                <button type="button" 
                                        wire:click="removeAttachment" 
                                        class="btn btn-sm position-absolute bg-white shadow-sm"
                                        style="position: absolute; top: -8px; right: -8px; padding: 2px; width: 24px; height: 24px; border-radius: 50%; border: 2px solid #d1a744; display: flex; align-items: center; justify-content: center;"
                                        title="Remove file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#d1a744" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Loading State for File Upload -->
                    <div wire:loading wire:target="attachment" class="mb-3">
                        <div class="p-2 bg-light rounded text-center">
                            <small class="text-info">Uploading file...</small>
                        </div>
                    </div>

                    <div class="chat-input">
                        @if($rfqStatus === 'open')
                            <form wire:submit="sendMessage" class="w-100">
                                <input type="text" 
                                    wire:model="messageText"
                                    class="chat-input__field flex-grow-1" 
                                    placeholder="Send a message"
                                    wire:keydown.enter.prevent="sendMessage"
                                    oninput="handleTyping()"
                                    id="message-input">
                                
                                <div class="chat-input__actions">
                                    <!-- File Upload Button -->
                                    <label class="btn btn-link text-muted me-2 mb-0 cursor-pointer" for="file-upload">
                                        <img src="{{ asset('images/icons/attachment.svg') }}">
                                        <input type="file" 
                                            id="file-upload" 
                                            wire:model="attachment" 
                                            style="display: none;"
                                            accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt">
                                    </label>
                                    
                                    <!-- Send Button -->
                                    <button type="submit" class="send-btn text-white" wire:loading.attr="disabled" wire:loading.remove wire:target="sendMessage">
                                        <img src="{{ asset('images/icons/send.svg') }}">
                                    </button>
                                    <span wire:loading wire:target="sendMessage">
                                        <x-filament::loading-indicator class="h-5 w-5" />
                                    </span>
                                </div>
                            </form>
                        @else
                            <div>You closed the status and hence chat is closed!</div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="chat-row__right">
                <div class="card added-products border-0">
                    <div class="card-header">Added Products</div>
                    <ul class="list-group list-group-flush">
                        @if($rfqData->type === 'normal')
                            @forelse ($rfq_items as $item)
                                <li class="list-group-item">
                                    {{ $item->product ? $item->product->name . ' : ' . $item->quantity : 'N/A' }}
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No products added yet</li>
                            @endforelse
                        @else
                                @if($rfq_items->customProduct && $rfq_items->customProduct->structure_file)
                                    <li class="list-group-item">
                                        <img src="{{ asset('storage/' . $rfq_items->customProduct->structure_file) }}" 
                                            alt="Structure" 
                                            style="max-width: 300px;">
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    {{ $rfq_items->customProduct ? $rfq_items->customProduct->molecule_name . ' : ' . $rfq_items->customProduct->quantity . $rfq_items->customProduct->unit : 'N/A' }}
                                </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Real-time Chat -->
    <script>
        let pollingInterval;
        let typingTimeout;
        let isUserTyping = false;
        let isPollingActive = true;

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('message-sent', () => {
                scrollChatToBottom();
            });
            
            Livewire.on('new-messages-received', (event) => {
                const newMessageCount = event[0];
                scrollChatToBottom();
                
                showNewMessageNotification(newMessageCount);
            });
            
            Livewire.on('resume-polling-after-delay', () => {
                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(() => {
                    isUserTyping = false;
                    @this.call('resumePolling');
                    startPolling();
                }, 3000);
            });
            
            scrollChatToBottom();
            startPolling();
        });
        
        function startPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
            
            pollingInterval = setInterval(() => {
                if (isPollingActive && !isUserTyping) {
                    @this.call('checkForNewMessages');
                }
            }, 5000); 
        }
        
        function stopPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        }
        
        function scrollChatToBottom() {
            const container = document.getElementById('chat-messages-container');
            if (container) {
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 100);
            }
        }
        
        function handleTyping() {
            if (!isUserTyping) {
                isUserTyping = true;
                @this.call('userStartedTyping');
            }
            
            clearTimeout(typingTimeout);
            typingTimeout = setTimeout(() => {
                isUserTyping = false;
                @this.call('resumePolling');
            }, 3000); 
        }
        
        function showNewMessageNotification(count) {
            console.log(`${count} new message(s) received from user`);
        }
        
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                isPollingActive = false;
                stopPolling();
            } else {
                isPollingActive = true;
                startPolling();
                @this.call('checkForNewMessages');
            }
        });
        
        window.addEventListener('beforeunload', () => {
            stopPolling();
        });
        
        document.addEventListener('livewire:update', () => {
            scrollChatToBottom();
        });
        
        window.addEventListener('online', () => {
            if (isPollingActive) {
                startPolling();
            }
        });
        
        window.addEventListener('offline', () => {
            stopPolling();
        });
    </script>
</x-filament-panels::page>