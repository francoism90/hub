<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Groups\Actions\GetMixerDiscover;
use Domain\Groups\Actions\GetMixerRecommended;
use Domain\Groups\Actions\GetMixerTagged;
use Domain\Groups\Actions\PopulateGroupDiscover;
use Domain\Groups\Actions\PopulateGroupRecommended;
use Domain\Groups\Actions\PopulateGroupTagged;
use Domain\Groups\Enums\GroupSet;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\LazyCollection;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Items extends Component
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    #[Modelable]
    public QueryForm $form;

    public function render(): View
    {
        return view('app.videos.items.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.items.placeholder', $params);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function mix(): void
    {
        $this->clear();

        $this->fillPageItems();

        $this->dispatch('$refresh');
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form, user: $this->getAuthModel())
        )->simplePaginate(perPage: 12, page: $page);
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
