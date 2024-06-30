<?php

namespace App\Profile\Http\Controllers;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Number;
use Illuminate\Support\Sleep;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Session;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('components.layouts.simple')]
class FeedController extends Page
{
    use WithoutUrlPagination;
    use WithPagination;
    use WithQueryBuilder;

    #[Session(key: 'feed-preview')]
    public bool $preview = true;

    #[Locked]
    public array $models = [];

    public function render(): View
    {
        return view('livewire.app.feed.index');
    }

    public function mount(): void
    {
        if (blank($this->models)) {
            $range = range(1, $this->getLimit());

            foreach ($range as $page) {
                $this->mergeItems($this->getItems($page)->all());

                Sleep::for(100)->milliseconds();
            }
        }
    }

    #[Computed]
    public function items(): array
    {
        return $this->models;
    }

    public function fetch(): void
    {
        $this->nextPage();

        $this->mergeItems(
            $this->getItems()->all()
        );
    }

    public function clear(): void
    {
        app($this->getModelClass())::forgetRandomSeed('feed');

        $this->reset('models');

        unset($this->items);

        $this->resetPage();
    }

    protected function getItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()
            ->with(['media', 'tags'])
            ->recommended()
            ->paginate(perPage: 12, page: $page);
    }

    protected function mergeItems(array $models = []): void
    {
        $this->models = array_merge_recursive($this->models, $models);
    }

    protected function getLimit(?int $page = null): int
    {
        $page ??= $this->getPage() ?? 1;

        return Number::clamp($page, 1, 24);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    protected function getTitle(): string
    {
        return __('Feed');
    }

    protected function getDescription(): string
    {
        return __('Personal Feed');
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
