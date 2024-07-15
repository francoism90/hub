<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use App\Web\Search\Scopes\FilterVideos;
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
            'suggestions' => $this->getSuggestions(),
        ]);
    }

    public function updated(): void
    {
        $this->form->validate();
    }

    #[Computed]
    public function items(): Paginator
    {
        $query = $this->form->query();

        return $this->getScout($query)->tap(
            new FilterVideos(form: $this->form)
        )->simplePaginate(12 * 4);
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->refresh();

        $this->resetPage();
    }

    public function clear(): void
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
        return $this->form->query() && $this->items()->isNotEmpty();
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
            ->limit(3)
            ->pluck('name')
            ->all();
    }

    protected function getTitle(): ?string
    {
        return __('Search');
    }

    protected function getDescription(): ?string
    {
        return $this->getTitle();
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => 'refresh',
            "echo-private:user.{$id},.video.restored" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
