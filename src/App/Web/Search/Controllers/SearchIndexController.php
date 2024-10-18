<?php

declare(strict_types=1);

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use App\Web\Groups\Concerns\WithGroup;
use App\Web\Search\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIndexController extends Page
{
    use WithAuthentication;
    use WithQueryBuilder;
    use WithPagination;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.search.index')->with([
            'types' => $this->getCollection(),
            'suggestions' => $this->getSuggestions(),
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
        $query = $this->form->query();

        return $this->getScout($query)
            ->tap(new FilterVideos(form: $this->form))
            ->simplePaginate(perPage: 16);
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

    protected function getCollection(): array
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
