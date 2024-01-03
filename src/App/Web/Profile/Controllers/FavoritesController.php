<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithFavorites;
use App\Web\Videos\Forms\PlaylistForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class FavoritesController extends Page
{
    use WithFavorites;
    use WithPagination;
    use WithQueryBuilder;

    protected static string $model = Video::class;

    public PlaylistForm $form;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Favorites'));
        $this->seo()->setDescription(__('Your Favorites'));
    }

    public function render(): View
    {
        return view('videos.index');
    }

    public function updatedForm(): void
    {
        $this->form->submit();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return static::favorites()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->when($this->form->isSort('oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->form->isSort('published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when($this->form->getSearch(), fn (Builder $query, string $value) => $query->search($value, true))
            ->take(32 * 32)
            ->paginate(32);
    }
}
