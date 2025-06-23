@props([
    'id' => 'custom-modal-id',
    'title' => __('messages.video_options'),
])


<div id="{{ $id ?? 'video-settings-modal' }}" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/90 transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4">
                    <h3 class="text-xl font-semibold text-gray-900" id="modal-title">{{ $title ?? __('messages.video_settings') }}</h3>
                    <p class="text-xs antialiased py-4"><span class="font-medium">*{{__('messages.Note')}}:</span> {{__('messages.password_change_instructions')}}</p>
                    <div class="mt-3 text-center flex flex-col justify-center gap-4">
                        <div class="text-sm text-gray-500 flex justify-between items-center">
                            <p>{{__('messages.allow_download')}}</p>
                            <input id="allow-download" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-black" />
                        </div>

                        <div class="text-sm text-gray-500 flex justify-between items-center">
                            <p>{{__('messages.set_url_expiration')}}</p>
                            <input id="datetime" type="text" class="border rounded-md px-4 py-2" placeholder="Select date and time">
                        </div>

                        <div class="text-sm text-gray-500 flex justify-between items-center">
                            <p>{{__('messages.password')}}</p>
                            <input id="video-password"type="text" name="video-password" class="border rounded-md px-4 py-2" placeholder="Enter password here..">
                        </div>

                        <div class="text-sm text-gray-500 flex justify-between items-center" data-share-url>
                            <p>{{__('messages.url_to_share')}} </p>
                            <x-button id="modal-share-url-btn" href="#" size="sm" onclick="copyShareURL()" data-url="">
                                {{__('messages.copy_url')}}
                            </x-button>
                        </div>

                        <div class="text-sm font-medium flex justify-between items-center flex-wrap gap-4" data-generate-url>
                            <p> {{__('messages.url_expired_regenerate')}}</p>
                            <x-button href="#" size="sm" onclick="generateUrl()">
                                {{__('messages.generate_url')}}
                            </x-button>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:justify-end sm:items-center sm:px-6 sm:gap-4">
                    <button data-save-settings type="button" onclick="generateUrl()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-300 sm:mt-0 sm:w-auto">{{__('messages.save_settings')}}</button>
                    <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-red-600 hover:text-white focus:outline-2 focus:ring-black sm:mt-0 sm:w-auto">{{__('messages.close')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
