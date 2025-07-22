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
                        <div class="alert alert-success form-submission-status">
                            {!! session('success') !!}
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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password">Create Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Create Password" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center my-4">
                            <hr class="flex-grow-1 border-dotted border-secondary">
                            <span class="px-3 text-muted small">Address Information</span>
                            <hr class="flex-grow-1 border-dotted border-secondary">
                        </div>

                        <div class="row">
                            {{-- <div class="col-md-12 mb-4">
                                <label for="autocomplete">Address</label>
                                <input 
                                    type="text" 
                                    id="autocomplete" 
                                    name="address" 
                                    class="form-control" 
                                    placeholder="Start typing your address..." 
                                    value="{{ old('address') }}"
                                >
                            </div>

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude"> --}}

                            <div class="col-md-6 mb-4">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="City name" value="{{ old('city') }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-select">
                                    <option value="">Select Country</option>
                                    <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="company">Company / Organization</label>
                                <input type="text" id="company" name="company" class="form-control" placeholder="Company/Organization name" value="{{ old('company') }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="purpose">Purpose</label>
                                <select id="purpose" name="purpose" class="form-select">
                                    <option value="">Select Purpose</option>
                                    <option value="Research" {{ old('purpose') == 'Research' ? 'selected' : '' }}>Research</option>
                                    <option value="Academic" {{ old('purpose') == 'Academic' ? 'selected' : '' }}>Academic</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="province">Province</label>
                                <select id="province" name="province" class="form-select">
                                    <option value="">Select Province</option>
                                    <option value="Alabama" {{ old('province') == 'Alabama' ? 'selected' : '' }}>Alabama</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Postal Code" value="{{ old('postal_code') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-yellow my-0 mx-auto d-block" onclick="$('#sh-loader').removeClass('d-none')">Register</button>
                        <div class="d-flex flex-column align-items-center mt-4">
                            <p>Forgot <a href="{{ route('password.request') }}" target="_self">Username / Password?</a></p>
                            <p>Already have an account? <a href="{{ route('login') }}" target="_self">Login</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfF79-FDb0HDZWonGwzCNYelnjADS2WY&libraries=places"
    async defer>
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('autocomplete');
    if (!input) return;

    const autocomplete = new google.maps.places.Autocomplete(input, {
        types: ['geocode'], 
    });

    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        // Fill hidden lat/lng
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();

        // Clear previous values
        document.getElementById('city').value = '';
        document.getElementById('province').value = '';
        document.getElementById('postal_code').value = '';
        document.getElementById('country').value = '';

        // Loop through address components
        place.address_components.forEach(function(component) {
            const types = component.types;

            if (types.includes("locality")) {
                // City
                document.getElementById('city').value = component.long_name;
            }

            if (types.includes("administrative_area_level_1")) {
                // Province / State
                // if your <select> has options, you can set value directly if matches
                let provinceSelect = document.getElementById('province');
                let provinceName = component.long_name;
                // Try to match option by text
                for (let option of provinceSelect.options) {
                    if (option.text.toLowerCase() === provinceName.toLowerCase()) {
                        provinceSelect.value = option.value;
                        break;
                    }
                }
            }

            if (types.includes("postal_code")) {
                // Postal code
                document.getElementById('postal_code').value = component.long_name;
            }

            if (types.includes("country")) {
                // Country
                let countrySelect = document.getElementById('country');
                let countryName = component.long_name;
                for (let option of countrySelect.options) {
                    if (option.text.toLowerCase() === countryName.toLowerCase()) {
                        countrySelect.value = option.value;
                        break;
                    }
                }
            }
        });
    });
});
</script>

@endsection