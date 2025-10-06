@extends('layouts.main.mainLayout')

@section('title', 'Register | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite(['resources/js/pages/auth/register.js'])
@endsection

@section('content')

<!-- Login Form Sections -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center g-5">
            <div class="col-12 col-lg-8 d-flex flex-column align-items-center"> 
                <div class="form-section w-100">

                    {{-- Session Status --}}
                    @if (session('success'))
                        <div class="alert alert-success form-submission-status shadow-lg rounded-lg p-2">
                            {!! session('success') !!}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger form-submission-status shadow-lg rounded-lg p-2">
                            <ul class="mb-0">
                                 {{ $errors->first() }}
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{ old('name') }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password">Create Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Create Password" autocomplete>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="company">Company / Individual Name</label>
                                <input type="text" id="company" name="company" class="form-control" placeholder="Enter your Company's / Individual name" value="{{ old('company') }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter your Address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="City name" value="{{ old('city') }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-select">
                                    <option value="" selected disabled>Select Country</option>
                                    @foreach (get_all_countries() as $country)
                                        <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="province">Province</label>
                                <input type="province" id="province" name="province" class="form-control" placeholder="Province" value="{{ old('province') }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Postal Code" value="{{ old('postal_code') }}">
                            </div>

                            <input type="hidden" name="timezone" id="timezone">
                            <input type="hidden" name="ip_address" id="ip_address">
                        </div>
                        <div class="d-flex flex-wrap gap-3 justify-content-md-between justify-content-center align-items-center">
                            <div>
                                {!! NoCaptcha::display(['data-callback' => 'enableAuthRegisterSubmit']) !!}
                                @error('g-recaptcha-response')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button disabled id="auth_register_btn_submit" type="submit" class="btn-yellow" onclick="$('#sh-loader').removeClass('d-none')">Register</button>
                        </div>
                        <div class="d-flex flex-column align-items-center mt-4">
                            <p>Forgot <a href="{{ route('password.request') }}" target="_self">Password?</a></p>
                            <p>Already have an account? <a href="{{ route('login') }}" target="_self">Login</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Email Verification Modal -->
<div class="modal fade" id="emailVerificationModal" tabindex="-1" aria-labelledby="emailVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 text-center">
                <div class="w-100">
                    <h5 class="modal-title" id="emailVerificationModalLabel">Verify Your Email Address</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-3">Thanks for signing up! We've sent a verification link to your email address.</p>
                <p class="mb-4"><strong>You must verify your email before you can login to your account.</strong></p>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Please check your email (including spam folder) and click the verification link.
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <a href="{{ route('verification.notice.public') }}" class="btn btn-primary me-2">
                    <i class="fas fa-check-circle me-1"></i>
                    Go to Verification Page
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    @if(session('registered'))
        document.addEventListener('DOMContentLoaded', function() {
            var emailModal = new bootstrap.Modal(document.getElementById('emailVerificationModal'));
            emailModal.show();
        });
    @endif

    document.addEventListener('DOMContentLoaded', function() {
            fetch('https://ipapi.co/json/')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ip_address').value = data.ip;
                    document.getElementById('timezone').value = data.timezone;
                })
                .catch(err => console.error('Location detection failed:', err));
    });
</script>
@endsection