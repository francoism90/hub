<?php

declare(strict_types=1);

namespace Domain\Activities\Actions;

use Domain\Activities\Enums\ActivityType;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RemoveActivity
{
    public function handle(User $user, Model $model, ActivityType $type): mixed
    {
        return DB::transaction(function () use ($user, $model, $type) {
            return $model->removeActivity($user, $type);
        });
    }
}
