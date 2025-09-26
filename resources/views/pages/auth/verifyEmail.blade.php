@extends('layouts.main.mainLayout')

@section('title', 'Verify Email | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite([])
@endsection

@section('content')

<section class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center g-5">
            <div class="col-12 col-lg-6 d-flex flex-column align-items-center"> 
                <div class="form-section w-100">

                    <div class="mb-4 text-center">
                        <h4 class="fw-bold">Verify Your Email Address</h4>
                        <p class="text-muted text-center">Please enter your email address to receive a new verification link.</p>
                    </div>

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

                    <form method="POST" action="{{ route('verification.resend.public') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email address" value="{{ old('email') }}" required autofocus>
                        </div>

                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Resend Verification Email</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none">Back to login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection