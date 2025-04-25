<?php

declare(strict_types=1);

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\QueryForm;
use App\Web\Tags\Scopes\FilterVideos;
use Domain\Groups\Enums\GroupSet;
use Domain\Videos\Models\Video;
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

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.tags.view')->with([
            'types' => $this->getTypes(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();

        $this->refresh();
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true, seconds: 60 * 60 * 24)]
    public function items(): Paginator
    {
        return $this->getScout()
            ->tap(new FilterVideos(form: $this->form, tag: $this->tag))
            ->simplePaginate(perPage: 36);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTypes(): array
    {
        return [
            GroupSet::Newest,
            GroupSet::Ordered,
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

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
