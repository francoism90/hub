<?php

declare(strict_types=1);

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use App\Web\Search\Scopes\FilterVideos;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\WithoutUrlPagination;

class SearchIndexController extends Page
{
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.search.index')->with([
            'suggestions' => $this->getSuggestions(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage();

        $query = $this->form->query();

        return $this->getScout($query)
            ->tap(new FilterVideos(form: $this->form))
            ->simplePaginate(perPage: 16, page: $page);
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->clear();

        $this->fillPageItems();

        $this->dispatch('$refresh');
    }

    public function blank(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function hasResults(): bool
    {
        return $this->form->query() && $this->getPageItems()->count();
    }

    public function setQuery(?string $query = null): void
    {
        $this->canViewAny($this->getModelClass());

        $this->form->query = $query;
    }

    protected function getSuggestions(): array
    {
        return Tag::query()
            ->inRandomOrder()
            ->limit(2)
            ->pluck('name')
            ->all();
    }

    protected function getTitle(): ?string
    {
        return __('Search');
    }

    protected function getDescription(): ?string
    {
        return __('Search for videos');
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
