@extends('layouts.authLayout')
@section('title', 'Login')
@section('content')
<div class="flex justify-center items-top gap-12 h-full shadow-red-500">
    <div class="w-full md:w-1/2 lg:w-2/5 px-4 shadow-red-500">
        <div class="bg-gray-200 rounded-lg p-8">
            <div class="mb-6">
                <h2 class="text-center text-[2.5rem] font-bold text-black my-4 wrap-break-word">{{__('messages.members_login')}}</h2>
                <p class="mb-6 text-sm text-gray-600 text-center">
                <strong>{{__('messages.note')}}:</strong> {{__('messages.login_note_1')}} <strong>{{__('messages.active_dir')}}.</strong>. {{__('messages.login_note_2')}} <strong>{{__('messages.admin')}}</strong> {{__('messages.login_note_3')}}
                </p>
            </div>

            @if(session('ldap-auth-error'))
                <div id="error_message" class="mb-4 p-4 rounded text-red-600 text-sm">
                    {{ session('ldap-auth-error') }}
                </div>
            @endif
            
            <form id="login" method="post" action="{{ url('/login') }}" method="POST">
                @csrf
            <div class="mb-4 relative">
                <label for="username" class="sr-only">{{__('messages.username')}}</label>
                <input type="text" name="username" id="username"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black-500"
                    placeholder="{{__('messages.username')}}" autocomplete="username" required>
                <span class="absolute right-3 top-3 text-gray-400">
                    <i class="fa fa-user"></i>
                </span>
            </div>

            <div class="mb-6 relative">
                <input type="password" name="password" id="password"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black-500"
                    placeholder="**********" autocomplete="password" required>
                <span class="absolute right-3 top-3 text-gray-400 cursor-pointer" onclick="handleChangeEyeIcon()">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            <div>
                <input type="submit" value="{{ __('messages.sign_in') }}" id="signin" class="w-full bg-black hover:bg-red-600 text-white font-semibold py-3 rounded cursor-pointer">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection