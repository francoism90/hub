<?php

declare(strict_types=1);

namespace Domain\Transcodes\Policies;

use Domain\Users\Models\User;
use Domain\Transcodes\Models\Transcode;

class TranscodePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Transcode $transcode): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Transcode $transcode): bool
    {
        return $transcode->user()->is($user) || $user->hasRole('super-admin');
    }

    public function delete(User $user, Transcode $transcode): bool
    {
        return $transcode->user()->is($user) || $user->hasRole('super-admin');
    }

    public function restore(User $user, Transcode $transcode): bool
    {
        return $transcode->user()->is($user) || $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Transcode $transcode): bool
    {
        return $user->hasRole('super-admin');
    }
}
