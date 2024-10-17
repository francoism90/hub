<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\CreateMixerGroups;
use Domain\Groups\Actions\RemoveMixerGroups;
use Domain\Groups\Models\Group;
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
        return view('app.videos.index')->with([
            'group' => $this->getGroup(),
        ]);
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

    public function mix(): void
    {
        $this->removeMixers();

        $this->setupMixers();

        $this->refresh();
    }

    #[Computed(persist: true, seconds: 7200)]
    public function items(): Collection
    {
        return Group::query()
            ->where('user_id', $this->getAuthId())
            ->mixer()
            ->published()
            ->orderBy('order_column')
            ->take(7)
            ->get();
    }

    protected function getGroup(): ?Group
    {
        return Group::findByPrefixedId($this->form->group) ?? $this->items()->first();
    }

    protected function removeMixers(): void
    {
        app(RemoveMixerGroups::class)->execute($this->getAuthModel());
    }

    protected function setupMixers(): void
    {
        app(CreateMixerGroups::class)->execute($this->getAuthModel());
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
