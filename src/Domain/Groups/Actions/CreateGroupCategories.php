<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupCategory;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateGroupCategories
{
    public function execute(User $user): Collection
    {
        return DB::transaction(function () use ($user) {
            $mixers = GroupCategory::cases();

            $items = collect();

            foreach ($mixers as $mixer) {
                $model = app(CreateNewGroup::class)->execute($user, [
                    'name' => $mixer->value,
                    'type' => GroupType::Mixer,
                ]);

                $items->push($model);
            }

            return $items;
        });
    }
}
