<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use Domain\Groups\Actions\CreateMixerGroups;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class VideoIndexController extends Page
{
    use WithAuthentication;
    use WithoutUrlPagination;
    use WithQueryBuilder;
    use WithScroll;

    public QueryForm $form;

    public function mount(): void
    {
        $this->setupMixers();

        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.videos.index');
    }

    public function updatedForm(): void
    {
        $this->form->submit();

        $this->clear();
    }

    public function populate(): void
    {
        $this->setupMixers(force: true);

        unset($this->lists);

        $this->form->reset('list');

        $this->refresh();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function reload(): void
    {
        $this->clear();

        $this->fetch();

        $this->refresh();
    }

    #[Computed(persist: true, seconds: 3600)]
    public function lists(): Collection
    {
        $items = collect($this->getAuthModel()->storeValue('mixers'));

        $items = $items->map(function (mixed $item) {
            if (str($item)->startsWith('tag-')) {
                $model = Tag::findByPrefixedId($item);

                return fluent(['key' => $model->getRouteKey(), 'label' => $model->name]);
            }

            if ($enum = GroupSet::from($item)) {
                return fluent(['key' => $enum->value, 'label' => $enum->label()]);
            }

            return null;
        });

        return $items;
    }

    protected function getPageItems(?int $page = null): Paginator
    {
        $page ??= $this->getPage() ?? 1;

        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form, user: $this->getAuthModel())
        )->simplePaginate(perPage: 16, page: $page);
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    protected function setupMixers(?bool $force = null): void
    {
        app(CreateMixerGroups::class)->execute($this->getAuthModel(), $force);
    }

    protected function getTitle(): ?string
    {
        return __('Stream Videos');
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch videos');
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
