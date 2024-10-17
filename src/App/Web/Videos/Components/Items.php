<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\PopulateGroupTagged;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
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
        // $this->setItems(force: true);

        // $this->clear();

        // $this->fillPageItems();

        // $this->dispatch('$refresh');
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage();

        $model = $this->getGroup();

        if ($model->kind === GroupSet::Tagged && ($tag = Tag::find($model->options?->tag))) {
            app(PopulateGroupTagged::class)->execute($this->getAuthModel(), $tag);
        }

        return $model
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
