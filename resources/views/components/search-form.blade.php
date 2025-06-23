@props([
    'placeholder'=>__('messages.enter_directory_code'),
    'id' => 'listing-code-form'
])

<form id="{{ $id }}" class="w-full max-w-md" method="POST" action="{{ route('folder.details') }}">
    @csrf

    @error('default-search')
        <div class="text-sm text-red-500 my-4">{{ $message }}</div>
    @enderror

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <div>
            <input type="search" id="default-search" name="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                placeholder="{{ $placeholder }}" value="{{ old('default-search') }}" required />
            <button type="submit"
                class="cursor-pointer text-white absolute end-2.5 bottom-2.5 bg-black hover:bg-red-600 focus:ring-3 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-4 py-2">
                {{__('messages.go')}}
            </button>
        </div>
    </div>
</form>
