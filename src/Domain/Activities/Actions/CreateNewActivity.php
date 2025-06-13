<?php

declare(strict_types=1);

namespace Domain\Activities\Actions;

use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateNewActivity
{
    public function handle(User $user, Model $model, ActivityType $type, array $attributes = []): Activity
    {
        return DB::transaction(function () use ($user, $model, $type, $attributes) {
            // Set default attributes
            $attributes['user_id'] = $user->getKey();
            $attributes['type'] = $type;

            // Create model if not exists
            $activity = $model->activities()->firstOrCreate(
                Arr::only($attributes, ['user_id', 'type']),
                Arr::only($attributes, app(Activity::class)->getFillable()),
            );

            return $activity;
        });
    }
}
