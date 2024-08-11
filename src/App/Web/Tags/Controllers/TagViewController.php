<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class TagViewController extends Page
{
    use WithPagination;
    use WithTag;

    public function render(): View
    {
        return view('app.tags.view');
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true)]
    public function items(): Paginator
    {
        return $this->tag
            ->videos()
            ->tagged(60 * 60 * 24 * 72)
            ->simplePaginate(12 * 4);
    }

    protected function getTitle(): string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): string
    {
        return (string) $this->tag->description;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
