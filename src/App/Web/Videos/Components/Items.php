<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\PopulateGroupDiscover;
use Domain\Groups\Actions\PopulateGroupRecommended;
use Domain\Groups\Actions\PopulateGroupTagged;
use Domain\Groups\Actions\ResetMixerGroups;
use Domain\Groups\Enums\GroupSet;
use Domain\Videos\Models\Video;
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
    use WithGroup;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    #[Modelable]
    public QueryForm $form;

    public function boot(): void
    {
        $this->fillMixerItems();
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

    public function mix(): void
    {
        $this->fillMixerItems(force: true);

        $this->refresh();
    }

    protected function fillMixerItems(?bool $force = null): void
    {
        $model = $this->getGroup();

        switch ($model->kind) {
            case GroupSet::Tagged:
                app(PopulateGroupTagged::class)->execute($model, $force);
                break;
            case GroupSet::Discover:
                app(PopulateGroupDiscover::class)->execute($model, $force);
                break;
            default:
                app(PopulateGroupRecommended::class)->execute($model, $force);
                break;
        }
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage();

        return $this->getGroup()
            ->videos()
            ->take(72)
            ->simplePaginate(perPage: 12, page: $page);
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.group.trashed" => 'refresh',
            "echo-private:user.{$id},.group.updated" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
