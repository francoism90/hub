<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Domain\Users\Notifications\ModelFollowed;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\Followable;

class MarkModelAsFollowing
{
    public function execute(Model $model, User $user, bool $force = false): void
    {
        throw_if(! in_array(Followable::class, class_uses_recursive($model)));

        $force
            ? $user->follow($model)
            : $user->toggleFollow($model);

        $user->notify(new ModelFollowed($model));
    }
}
