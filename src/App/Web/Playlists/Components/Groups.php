<?php

declare(strict_types=1);

namespace App\Web\Playlists\Components;

use Domain\Groups\Models\Group;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class Groups extends Component
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    public function render(): View
    {
        return view('app.playlists.groups.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.playlists.groups.placeholder', $params);
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

    protected function getModelClass(): ?string
    {
        return Group::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.group.trashed" => '$refresh',
            "echo-private:user.{$id},.group.updated" => '$refresh',
        ];
    }
}
