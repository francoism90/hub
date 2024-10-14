<?php

declare(strict_types=1);

namespace App\Web\Groups\Controllers;

use App\Web\Groups\Concerns\WithGroup;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class GroupViewController extends Page
{
    use WithGroup;
    use WithPagination;

    public function render(): View
    {
        return view('app.groups.view');
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true)]
    public function items(): Paginator
    {
        return $this->getGroup()
            ->videos()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(12 * 4);
    }

    public function onGroupUpdated(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTitle(): ?string
    {
        return (string) $this->group->title;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->group->content;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getGroupListeners(),
        ];
    }
}
