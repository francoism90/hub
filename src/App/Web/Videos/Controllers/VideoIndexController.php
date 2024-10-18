<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\CreateMixerGroups;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
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
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function reload(): void
    {
        $this->setupMixers(force: true);

        $this->form->reset('list');

        $this->refresh();
    }

    #[Computed(persist: true, seconds: 3600)]
    public function items(): Collection
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
}
