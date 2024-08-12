<?php

namespace App\Web\Lists\Controllers;

use App\Web\Lists\Concerns\WithPlaylist;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ListViewController extends Page
{
    use WithPagination;
    use WithPlaylist;

    public function render(): View
    {
        return view('app.lists.view');
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true)]
    public function items(): Paginator
    {
        return $this->getPlaylist()
            ->videos()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(12 * 4);
    }

    public function onPlaylistUpdated(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTitle(): string
    {
        return (string) $this->playlist->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->playlist->content;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getPlaylistListeners(),
        ];
    }
}
