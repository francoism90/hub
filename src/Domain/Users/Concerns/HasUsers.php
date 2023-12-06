<?php

namespace Domain\Users\Concerns;

use ArrayAccess;
use Domain\Users\Models\User;
use Domain\Users\Models\Userable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait HasUsers
{
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable')
            ->using(Userable::class)
            ->withPivot(['user_id', 'options'])
            ->withTimestamps();
    }

    public function attachUser(User $model, ?array $options = null): static
    {
        return $this->attachUsers([$model], $options);
    }

    public function attachUsers(array|ArrayAccess|User $users, ?array $options = null): static
    {
        $users = static::convertToUsers($users);

        $this->users()->syncWithPivotValues(
            ids: $users->pluck('id')->toArray(),
            values: ['options' => $options],
            detaching: false
        );

        return $this;
    }

    public function detachUser(User $user): static
    {
        return $this->detachUsers([$user]);
    }

    public function detachUsers(array|ArrayAccess $users): static
    {
        $users = static::convertToUsers($users);

        collect($users)
            ->filter()
            ->each(fn (User $user) => $this->users()->detach($user));

        return $this;
    }

    public static function convertToUsers(array|ArrayAccess|User $values): Collection
    {
        if ($values instanceof User) {
            $values = [$values];
        }

        return collect($values)
            ->map(fn (User|int $value) => $value instanceof User
                ? $value
                : User::find($value));
    }
}
