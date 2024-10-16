<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\PopulateGroupDaily;
use Domain\Groups\Actions\PopulateGroupDiscover;
use Domain\Groups\Models\Group;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
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

    public function boot(): void
    {
        $this->setItems();
    }

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

    public function regenerate(): void
    {
        $this->setItems(force: true);

        $this->clear();

        $this->fillPageItems();

        $this->dispatch('$refresh');
    }

    protected function setItems(?bool $force = false): void
    {
        switch ($this->form->type) {
            case 'discover':
                app(PopulateGroupDiscover::class)->execute($this->getAuthModel(), $force);
                break;
            default:
                app(PopulateGroupDaily::class)->execute($this->getAuthModel(), $force);
                break;
        }
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage();

        return $this->getGroupModel()
            ->videos()
            ->simplePaginate(perPage: 12, page: $page);
    }

    protected function getGroupModel(): ?Group
    {
        return $this->getQuery()
            ->mixer()
            ->where('user_id', $this->getAuthId())
            ->where('kind', $this->form->type)
            ->first();
    }

    protected function getModelClass(): ?string
    {
        return Group::class;
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
