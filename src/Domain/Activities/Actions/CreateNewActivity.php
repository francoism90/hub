<?php

declare(strict_types=1);

namespace Domain\Activities\Actions;

use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateNewActivity
{
    public function execute(User $user, array $attributes): Activity
    {
        return DB::transaction(function () use ($user, $attributes) {
            $model = $user->groups()->updateOrCreate(
                Arr::only($attributes, ['name', 'type']),
                Arr::only($attributes, app(Activity::class)->getFillable()),
            );

            return $model;
        });
    }
}
