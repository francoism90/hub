<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\CreateMixerGroups;
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
            'group' => $this->getModel(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();
    }

    #[Computed(persist: true, seconds: 7200)]
    public function items(): Collection
    {
        return Group::query()
            ->where('user_id', $this->getAuthId())
            ->mixer()
            ->published()
            ->take(5)
            ->get();
    }

    protected function setupMixers(): void
    {
        app(CreateMixerGroups::class)->execute($this->getAuthModel());
    }

    protected function getModel(): ?Group
    {
        $model = Group::firstWhere('prefixed_id', $this->form->group);

        $this->authorize('view', $model);

        return $model;
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
