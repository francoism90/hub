<?php

namespace App\Feed\Http\Controllers;

use Domain\Videos\Collections\VideoCollection;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Number;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class VideoIndexController extends Page
{
    use WithQueryBuilder;

    #[Locked]
    public int $limit = 5;

    public function render(): View
    {
        return view('livewire.app.pages.videos.index');
    }

    #[Computed()]
    public function items(): VideoCollection
    {
        return $this->getQuery()
            ->recommended()
            ->take($this->getLimit())
            ->get();
    }

    public function fetch(): void
    {
        $this->limit += 5;

        if ($this->getLimit() >= 100) {
            $this->limit = 5;
        }
    }

    protected function getLimit(): int
    {
        return Number::clamp($this->limit, min: 5, max: 100);
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
