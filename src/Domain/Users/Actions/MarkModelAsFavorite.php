<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Domain\Users\Notifications\ModelFavorited;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class MarkModelAsFavorite
{
    public function execute(Model $model, User $user, bool $force = false): void
    {
        throw_if(! in_array(Favoriteable::class, class_uses_recursive($model)));

        $force
            ? $user->favorite($model)
            : $user->toggleFavorite($model);

        $user->notify(new ModelFavorited($model));
    }
}
