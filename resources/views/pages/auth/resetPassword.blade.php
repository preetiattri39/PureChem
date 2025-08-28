@extends('layouts.main.mainLayout')

@section('title', 'Reset Password | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite([])
@endsection

@section('content')

<!-- Login Form Sections -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center g-5">
            <div class="col-12 col-lg-6 d-flex flex-column align-items-center"> 
                <div class="form-section w-100">

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="alert alert-success form-submission-status shadow-lg rounded-lg p-2">
                            {!! session('status') !!}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger form-submission-status shadow-lg rounded-lg p-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Password">
                        </div>

                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection