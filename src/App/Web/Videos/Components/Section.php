<?php

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Section extends Component
{
    use WithAuthentication;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('app.videos.section.scroller')->with([
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
            ->take(12)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return null;
    }

    protected function getDescription(): ?string
    {
        return null;
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
