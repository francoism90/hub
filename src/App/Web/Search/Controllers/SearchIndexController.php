<?php

declare(strict_types=1);

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use App\Web\Search\Scopes\FilterVideos;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class SearchIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.search.index')->with([
            'types' => $this->getTypes(),
            'suggestions' => $this->getSuggestions(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();

        $this->resetPage();

        $this->refresh();
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true, seconds: 60 * 60 * 24)]
    public function items(): Paginator
    {
        $query = $this->form->query();

        return $this->getScout($query)
            ->tap(new FilterVideos(form: $this->form))
            ->simplePaginate(perPage: 24);
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->refresh();
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

    public function setQuery(?string $query = null): void
    {
        $this->form->query = $query;

        $this->submit();
    }

    protected function getSuggestions(): array
    {
        if ($this->form->query()) {
            return [];
        }

        return Tag::query()
            ->inRandomOrder()
            ->limit(2)
            ->pluck('name')
            ->all();
    }

    protected function getTypes(): array
    {
        return [
            GroupSet::Relevant,
            GroupSet::Longest,
            GroupSet::Shortest,
        ];
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
