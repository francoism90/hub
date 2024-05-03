<?php

namespace App\Feed\Http\Controllers;

use Domain\Videos\Collections\VideoCollection;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Number;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Session;

#[Layout('components.layouts.simple')]
class FeedIndexController extends Page
{
    use WithQueryBuilder;

    #[Session(key: 'feed-preview')]
    public bool $preview = true;

    #[Locked]
    public int $limit = 12;

    public function render(): View
    {
        return view('livewire.app.pages.feed.index');
    }

    #[Computed()]
    public function items(): VideoCollection
    {
        return $this->getQuery()
            ->with(['media', 'tags'])
            ->randomSeed(key: 'videos', ttl: now()->addMinutes(10))
            ->take($this->getLimit())
            ->get();
    }

    public function fetch(): void
    {
        $this->limit += 16;

        if ($this->getLimit() >= 192) {
            $this->limit = 16;
        }
    }

    public function refresh(): void
    {
        app($this->getModelClass())::forgetRandomSeed('videos');

        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getLimit(): int
    {
        return Number::clamp($this->limit, min: 12, max: 120);
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
