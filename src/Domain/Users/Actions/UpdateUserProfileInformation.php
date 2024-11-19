<?php

declare(strict_types=1);

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateUserProfileInformation
{
    public function execute(User $user, array $attributes): void
    {
        DB::transaction(function () use ($user, $attributes) {
            if (array_key_exists('email', $attributes) && ($user->email !== $attributes['email'] && $user instanceof MustVerifyEmail)) {
                return $this->updateVerifiedUser($user, $attributes);
            }

            $user->updateOrFail(
                Arr::only($attributes, $user->getFillable())
            );
        });
    }

    protected function updateVerifiedUser(User $user, array $attributes): void
    {
        $user->forceFill([
            'name' => $attributes['name'] ?? $user->name,
            'email' => $attributes['email'],
            'email_verified_at' => null,
        ])->saveOrFail();

        $user->sendEmailVerificationNotification();
    }
}
