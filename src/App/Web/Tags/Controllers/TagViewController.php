<?php

declare(strict_types=1);

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Foxws\WireUse\Views\Support\Page;
use App\Web\Tags\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class TagViewController extends Page
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;
    use WithTag;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.tags.view')->with([
            'types' => $this->getCollection(),
        ]);
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true, seconds: 60 * 60 * 24)]
    public function items(): Paginator
    {
        return $this->getScout()
            ->tap(new FilterVideos($this->form, $this->tag))
            ->simplePaginate(perPage: 16);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    protected function getCollection(): array
    {
        return [
            GroupSet::Newest,
            GroupSet::Longest,
            GroupSet::Shortest,
        ];
    }

    protected function getTitle(): ?string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): ?string
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
