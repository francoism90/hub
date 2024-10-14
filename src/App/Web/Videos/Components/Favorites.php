<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use Domain\Groups\Models\Group;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Favorites extends Section
{
    public function boot(): void
    {
        $this->authorize('view', $this->getGroup());
    }

    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return $this->getGroup()
            ->videos()
            ->published()
            ->orderByDesc('groupables.updated_at')
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Favorites');
    }

    protected function getGroup(): ?Group
    {
        return $this->getAuthModel()->groups()->favorites();
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
