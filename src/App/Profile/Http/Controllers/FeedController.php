<?php

namespace App\Profile\Http\Controllers;

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
class FeedController extends Page
{
    use WithQueryBuilder;

    #[Session(key: 'feed-preview')]
    public bool $preview = true;

    #[Locked]
    public int $limit = 12;

    public function render(): View
    {
        return view('livewire.app.feed.index');
    }

    #[Computed()]
    public function items(): VideoCollection
    {
        return $this->getQuery()
            ->with(['media', 'tags'])
            ->recommended()
            ->take($this->getLimit())
            ->get();
    }

    public function fetch(): void
    {
        $this->limit += 12;

        if ($this->getLimit() >= 72) {
            $this->clear();
        }
    }

    public function clear(): void
    {
        app($this->getModelClass())::forgetRandomSeed('feed');

        unset($this->items);

        $this->reset('limit');

        $this->dispatch('$refresh');
    }

    protected function getTitle(): string
    {
        return __('Feed');
    }

    protected function getDescription(): string
    {
        return __('Feed');
    }

    protected function getLimit(): int
    {
        return Number::clamp($this->limit, min: 12, max: 72);
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