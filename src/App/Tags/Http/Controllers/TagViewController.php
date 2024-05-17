<?php

namespace App\Tags\Http\Controllers;

use App\Livewire\Tags\Concerns\WithTags;
use Domain\Relates\Collections\RelatedCollection;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class TagViewController extends Page
{
    use WithPagination;
    use WithQueryBuilder;
    use WithTags;

    public function render(): View
    {
        return view('livewire.app.tags.view');
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this
            ->getModel()
            ->findByPrefixedIdOrFail($this->getTagId())
            ->videos()
            ->randomSeed(key: 'tag', ttl: now()->addDay())
            ->simplePaginate(32);
    }

    #[Computed]
    public function relatables(): RelatedCollection
    {
        return $this
            ->getModel()
            ->findByPrefixedIdOrFail($this->getTagId())
            ->relates;
    }

    public function onTagDeleted(): void
    {
        $this->dispatch('$refresh');
    }

    public function onTagUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getTitle(): string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): string
    {
        return (string) $this->tag->description;
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
