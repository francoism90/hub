<?php

namespace App\Tags\Controllers;

use App\Tags\Concerns\WithTag;
use Domain\Relates\Collections\RelatedCollection;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class TagViewController extends Page
{
    use WithPagination;
    use WithQueryBuilder;
    use WithTag;

    public function render(): View
    {
        return view('tags.view');
    }

    public function getTitle(): string
    {
        return (string) $this->tag?->name;
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this->getQuery()
            ->findOrFail($this->getTagKey())
            ->videos()
            ->randomSeed(key: 'tag', ttl: now()->addDay())
            ->simplePaginate(32);
    }

    #[Computed]
    public function relatables(): RelatedCollection
    {
        return $this->getQuery()
            ->findOrFail($this->getTagKey())
            ->relates;
    }

    public function onTagDeleted(): void
    {
        unset($this->items);

        $this->refreshTag();
    }

    public function onTagUpdated(): void
    {
        unset($this->items);

        $this->refreshTag();
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
