<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

abstract class Section extends Component
{
    use WithAuthentication;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('app.videos.section.view')->with([
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.section.placeholder', $params);
    }

    #[Computed]
    public function items(): Collection
    {
        return $this->getQuery()
            ->published()
            ->take(24)
            ->get();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTitle(): ?string
    {
        return null;
    }

    protected function getDescription(): ?string
    {
        return null;
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
