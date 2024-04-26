<?php

namespace App\Videos\Controllers;

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
    public int $limit = 3;

    public function render(): View
    {
        return view('livewire.app.pages.index');
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
        $this->limit += 10;

        if ($this->getLimit() >= 100) {
            $this->limit = 10;
        }
    }

    protected function getLimit(): int
    {
        return Number::clamp($this->limit, min: 3, max: 100);
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
