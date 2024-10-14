<?php

declare(strict_types=1);

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait InteractsWithUser
{
    public static function bootInteractsWithUser(): void
    {
        static::creating(function (Model $model) {
            if (blank($model->user_id)) {
                $model->user_id = auth()->id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
