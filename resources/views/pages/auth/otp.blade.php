@extends('layouts.authLayout')
@section('title', 'OTP Verification')
@section('content')
<div class="flex justify-center items-top gap-12 h-full">
    <div class="w-full md:w-1/2 lg:w-1/3 px-4">
        <div class="bg-gray-200 rounded-lg p-8">
            <div class="mb-6">
                <h2 class="text-center text-[2.5rem] font-bold text-black my-4">{{__('messages.enter_otp')}}</h2>
                <p class="mb-6 text-sm text-gray-600 text-center">
                    {{__('messages.otp_instructions')}}
                </p>
            </div>

            @if(session('otp-error'))
                <div class="mb-4 p-4 rounded bg-red-100 text-red-700 text-sm">
                    {{ session('otp-error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/verify-otp') }}">
                @csrf
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text" name="otp[]" maxlength="1" inputmode="numeric"
                            class="otp-input w-14 h-14 text-center text-2xl border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black-500" title="{{__('messages.field_title')}}"
                            required>
                    @endfor
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-black hover:bg-red-600 text-white font-semibold py-3 rounded cursor-pointer">
                         {{__('messages.verify_otp')}}
                    </button>
                </div>
            </form>

            <div class="my-4 w-full text-center">
                <div>Didn't get the OTP ? Resend in <span id="timer-display">01:00</span></div>
                <i id="reload-icon" class="fa fa-refresh hidden" style="cursor: pointer;"></i>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const timerDisplay = document.getElementById('timer-display');
    const reloadIcon = document.getElementById('reload-icon');
    let countdownInterval;

    // Initialize timer
    function initTimer() {
        fetch('/get-timer')
            .then(response => response.json())
            .then(data => {
                if (data.expired) {
                    showReloadIcon();
                } else {
                    startCountdown(data.seconds_left);
                }
            });
    }

    // Start countdown
    function startCountdown(seconds) {
        clearInterval(countdownInterval);
        reloadIcon.classList.add('hidden');
        
        let remainingSeconds = seconds;
        updateTimerDisplay(remainingSeconds);
        
        countdownInterval = setInterval(() => {
            remainingSeconds--;
            updateTimerDisplay(remainingSeconds);
            
            if (remainingSeconds <= 0) {
                clearInterval(countdownInterval);
                showReloadIcon();
            }
        }, 1000);
    }

    // Update timer display
    function updateTimerDisplay(seconds) {
        const mins = Math.floor(seconds / 60).toString().padStart(2, '0');
        const secs = (seconds % 60).toString().padStart(2, '0');
        timerDisplay.textContent = `${mins}:${secs}`;
    }

    // Show reload icon
    function showReloadIcon() {
        timerDisplay.textContent = '00:00';
        reloadIcon.classList.remove('hidden');
    }

    // Handle reload click
    reloadIcon.addEventListener('click', function() {
        fetch('/resend-otp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                const secondsLeft = Math.floor((new Date(data.expires_at) - new Date()) / 1000);
                startCountdown(secondsLeft);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Initialize on page load
    initTimer();
});
</script>
@endsection
