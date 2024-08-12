<?php

namespace App\Web\Lists\Components;

use Domain\Playlists\Models\Playlist;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class Playlists extends Component
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    public function render(): View
    {
        return view('app.lists.playlists.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.playlists.placeholder', $params);
    }

    protected function getPageItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()
            ->where('user_id', $this->getAuthId())
            ->published()
            ->withCount('videos')
            ->paginate(perPage: 9, page: $page);
    }

    protected static function getModelClass(): ?string
    {
        return Playlist::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.trashed" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
