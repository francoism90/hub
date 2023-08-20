<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function update(User $user, array $attributes): mixed
    {
        Validator::make($attributes, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ])->validateWithBag('updateProfileInformation');

        if ($attributes['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            return $this->updateVerifiedUser($user, $attributes);
        }

        $user->forceFill([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ])->saveOrFail();
    }

    protected function updateVerifiedUser(User $user, array $attributes): void
    {
        $user->forceFill([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'email_verified_at' => null,
        ])->saveOrFail();

        $user->sendEmailVerificationNotification();
    }
}
