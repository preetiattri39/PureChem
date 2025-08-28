@extends('layouts.main.mainLayout')

@section('title', 'Register | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite([])
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
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
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
                        </div>
                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Register</button>
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
@endsection