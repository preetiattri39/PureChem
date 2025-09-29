<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                Auth::logout();
                session()->flash('registered', true);
                return redirect('/register');
            }
        });

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                if (!Auth::user()->hasVerifiedEmail()) {
                    Auth::logout();
                    return redirect()->route('verification.notice.public')->withErrors([
                        'email' => 'You must verify your email address before you can log in. Please check your email or request a new link . '
                    ]);
                }

                return redirect(config('fortify.home'));
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('pages.auth.login');
        });

        // Fortify::authenticateUsing(function (Request $request) {
        //     $user = User::where('email', $request->email)->first();
        //     if ($user && Hash::check($request->password, $user->password)) {
        //         if ($user->role === 'user') {
        //             return $user;
        //         }
        //     }
        //     return null;
        // }); 

        Fortify::registerView(function () {
            return view('pages.auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('pages.auth.forgotPassword');
        });

        Fortify::resetPasswordView(function () {
            return view('pages.auth.resetPassword');
        });

        Fortify::verifyEmailView(function () {
            return view('pages.auth.verifyEmail');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
