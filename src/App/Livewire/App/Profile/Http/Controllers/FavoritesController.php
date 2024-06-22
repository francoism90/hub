<?php

namespace App\Profile\Http\Controllers;

use App\Livewire\Playlists\Concerns\WithFavorites;
use App\Livewire\Playlists\Concerns\WithHistory;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class FavoritesController extends Page
{
    use WithAuthentication;
    use WithFavorites;
    use WithPagination;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('livewire.app.profile.favorites');
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::favorites()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(32);
    }

    protected function getTitle(): string
    {
        return __('Favorites');
    }

    protected function getDescription(): string
    {
        return __('Favorites');
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::favorites()->getRouteKey();

        return [
            "echo-private:playlist.{$id},.playlist.deleted" => '$refresh',
            "echo-private:playlist.{$id},.playlist.updated" => '$refresh',
        ];
    }
}
