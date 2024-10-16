<?php

declare(strict_types=1);

namespace App\Web\Groups\Components;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Groups\Forms\QueryForm;
use App\Web\Groups\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Items extends Component
{
    use WithAuthentication;
    use WithGroup;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    #[Modelable]
    public QueryForm $form;

    public function render(): View
    {
        return view('app.groups.items.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.groups.items.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getPageItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()
            ->tap(new FilterVideos($this->form, $this->group))
            ->take(12 * 8)
            ->paginate(perPage: 12, page: $page);
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }
}
