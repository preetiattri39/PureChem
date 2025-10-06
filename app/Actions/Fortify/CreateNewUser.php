<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'phone' => ['nullable', 'regex:/^\d{1,12}$/'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'company' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'timezone' => ['nullable', 'string', 'max:100'],
            'ip_address' => ['nullable', 'string', 'max:100'],
            'g-recaptcha-response' => 'required|captcha',
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? null,
            'city' => $input['city'] ?? null,
            'country' => $input['country'] ?? null,
            'company' => $input['company'] ?? null,
            'address' => $input['address'] ?? null,
            'purpose' => $input['purpose'] ?? null,
            'province' => $input['province'] ?? null,
            'postal_code' => $input['postal_code'] ?? null,
            'timezone' => $input['timezone'] ?? 'UTC',
            'ip_address' => $input['ip_address'] ?? request()->ip(),
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }
}
