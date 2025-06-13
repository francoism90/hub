<?php

declare(strict_types=1);

namespace Domain\Activities\Actions;

use Domain\Activities\Enums\ActivityType;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToggleActivity
{
    public function handle(User $user, Model $model, ActivityType $type, bool $force = false): mixed
    {
        return DB::transaction(function () use ($user, $model, $type, $force) {
            return $model->hasActivity($user) || ! $force
                ? app(RemoveActivity::class)->handle($user, $model, $type)
                : app(CreateNewActivity::class)->handle($user, $model, $type);
        });
    }
}
