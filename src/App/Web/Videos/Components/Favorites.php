<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Account\Concerns\WithActivities;
use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Favorites extends Section
{
    use WithActivities;

    public function boot(): void
    {
        $this->authorize('view', $this->getAuthModel());
    }

    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return Activity::query()
            ->where('user_id', $this->getAuthKey())
            ->where('type', ActivityType::Favorite)

    }

    protected function getTitle(): ?string
    {
        return __('Favorites');
    }

    protected function getUrl(): ?string
    {
        return '';

        // return route('groups.view', $this->getGroup());
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.group.trashed" => 'refresh',
            "echo-private:user.{$id},.group.updated" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
