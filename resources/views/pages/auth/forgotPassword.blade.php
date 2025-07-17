@extends('layouts.main.mainLayout')

@section('title', 'Forgot Password | Swizchem')
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
                        <div class="alert alert-success form-submission-status">
                            {!! session('status') !!}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger form-submission-status">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        </div>

                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Send Password Reset Link</button>
                        <div class="d-flex flex-column align-items-center mt-4">
                            <p>Already have an account? <a href="{{ route('login') }}" target="_self">Login</a> </p>
                            <p>Don't have an account? <a href="{{ route('register') }}" target="_self">Sign up</a> </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection