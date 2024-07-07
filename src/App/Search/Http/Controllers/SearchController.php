<?php

namespace App\Search\Http\Controllers;

use App\Livewire\Search\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class SearchController extends Page
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('livewire.app.search.index');
    }

    public function updated(): void
    {
        $this->form->submit();

        $this->resetPage();
    }

    #[Computed]
    public function items(): Paginator
    {
        $search = $this->form->query();

        return $this->getScout($search)
            ->when($search->isEmpty(), fn (Builder $query) => $query->whereIn('id', [0]))
            ->simplePaginate(4 * 12);
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

    protected function getTitle(): string
    {
        return __('Search');
    }

    protected function getDescription(): string
    {
        return __('Search');
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
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
