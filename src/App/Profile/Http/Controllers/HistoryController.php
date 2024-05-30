<?php

namespace App\Profile\Http\Controllers;

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
class HistoryController extends Page
{
    use WithAuthentication;
    use WithHistory;
    use WithPagination;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('livewire.app.feed.history');
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::history()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(32);
    }

    protected function getTitle(): string
    {
        return __('History');
    }

    protected function getDescription(): string
    {
        return __('History');
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::history()->getRouteKey();

        return [
            "echo-private:playlist.{$id},.playlist.deleted" => '$refresh',
            "echo-private:playlist.{$id},.playlist.updated" => '$refresh',
        ];
    }
}
