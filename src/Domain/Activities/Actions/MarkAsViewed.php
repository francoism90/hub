<?php

declare(strict_types=1);

namespace Domain\Activities\Actions;

use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MarkAsViewed
{
    public function execute(User $user, Model $model, array $attributes = []): Activity
    {
        return DB::transaction(function () use ($user, $model, $attributes) {
            $attributes = [...$attributes, ...$this->getAttributes($model)];

            $model = $user->activities()->updateOrCreate(
                Arr::only($attributes, ['model_id', 'model_type', 'name', 'type']),
                Arr::only($attributes, app(Activity::class)->getFillable()),
            );

            $model->touch();

            return $model;
        });
    }

    protected function getAttributes(Model $model): array
    {
        return [
            'model_id' => $model->getKey(),
            'model_type' => $model->getMorphClass(),
            'type' => ActivityType::Viewed,
        ];
    }
}
