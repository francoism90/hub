<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Actions\CreateMixerGroups;
use Domain\Groups\Models\Group;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    public QueryForm $form;

    public function boot(): void
    {
        $this->setupMixers();
    }

    public function mount(): void
    {
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
        return Group::query()
            ->when($this->form->group, fn (Builder $query, string $value) => $query->where('prefixed_id', $value))
            ->first();
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
