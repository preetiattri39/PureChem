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
                                
                                @if($message['is_admin'])
                                    <div class="chat-bubble-left">
                                        @if(!empty($message['message']))
                                            {{ $message['message'] }}
                                        @endif
                                        
                                        @if(isset($message['attachments']) && count($message['attachments']) > 0)
                                            @foreach($message['attachments'] as $attachment)
                                                <div class="mt-2">
                                                    @if(str_starts_with($attachment['file_type'], 'image/'))
                                                        <img src="{{ $attachment['file_url'] }}" 
                                                             alt="{{ $attachment['file_name'] }}" 
                                                             class="max-w-full h-auto rounded"
                                                             style="max-width: 100px;">
                                                    @else
                                                        <a href="{{ $attachment['file_url'] }}" 
                                                           download="{{ $attachment['file_name'] }}" 
                                                           class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                                                            <img src="{{ asset('images/icons/attachment.svg') }}" class="w-4 h-4">
                                                            <span>{{ $attachment['file_name'] }}</span>
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
                                            @foreach($message['attachments'] as $attachment)
                                                <div class="mt-2">
                                                    @if(str_starts_with($attachment['file_type'], 'image/'))
                                                        <img src="{{ $attachment['file_url'] }}" 
                                                             alt="{{ $attachment['file_name'] }}" 
                                                             class="max-w-full h-auto rounded"
                                                             style="max-width: 100px;">
                                                    @else
                                                        <a href="{{ $attachment['file_url'] }}" 
                                                           download="{{ $attachment['file_name'] }}" 
                                                           class="text-white hover:text-gray-200 flex items-center space-x-1">
                                                            <img src="{{ asset('images/icons/attachment.svg') }}" class="w-4 h-4">
                                                            <span>{{ $attachment['file_name'] }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="chat-time text-center">{{ now()->format('h:i A') }}</div>
                            <div class="chat-bubble-left">
                                Welcome to the chat! How can we help you?
                            </div>
                        @endif
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
                            
                            <!-- File Upload Preview -->
                            @if($attachment)
                                {{-- <div class="mt-2 p-2 bg-light rounded">
                                    <small class="text-success">
                                        <strong>File selected:</strong> {{ $attachment['file_name'] }}
                                        <button type="button" 
                                                wire:click="removeAttachment" 
                                                class="btn btn-sm btn-outline-danger ms-2">
                                            Remove
                                        </button>
                                    </small>
                                </div> --}}
                            @endif
                            
                            <!-- Loading State for File Upload -->
                            <div wire:loading wire:target="attachment" class="mt-2">
                                <small class="text-info">Uploading file...</small>
                            </div>
                        @else
                            <div>Chat is closed by Admin!</div>
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
            console.log(`${count} new message(s) received`);
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