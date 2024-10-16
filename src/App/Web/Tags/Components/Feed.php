<?php

declare(strict_types=1);

namespace App\Web\Tags\Components;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\QueryForm;
use App\Web\Tags\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Feed extends Component
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;
    use WithTag;

    #[Modelable]
    public QueryForm $form;

    public function render(): View
    {
        return view('app.tags.feed.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.tags.feed.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getPageItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getScout()
            ->tap(new FilterVideos($this->form, $this->tag))
            ->paginate(perPage: 12, page: $page);
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
