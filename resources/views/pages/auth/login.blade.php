@extends('layouts.main.mainLayout')

@section('title', 'Login | Swizchem')
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

                    {{-- Flash Errors --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        </div>

                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Login</button>
                        <div class="d-flex flex-column align-items-center mt-4">
                            <p>Forgot <a href="{{ route('password.request') }}" target="_self">Password?</a></p>
                            <p>Don't have an account? <a href="{{ route('register') }}" target="_self">Sign up</a> </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection