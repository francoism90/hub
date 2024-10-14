<?php

namespace App\Web\Videos\Components;

use Domain\Groups\Models\Group;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Watching extends Section
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
            ->orderByDesc('videoables.updated_at')
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Continue Watching');
    }

    protected function getGroup(): Group
    {
        return $this->getAuthModel()
            ->groups()
            ->history();
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.playlist.trashed" => 'refresh',
            "echo-private:user.{$id},.playlist.updated" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
