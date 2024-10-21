<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Groups\Actions\GetUserSuggestions;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Layout\Concerns\WithScroll;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
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
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.videos.index');
    }

    public function updatedForm(): void
    {
        $this->form->submit();

        $this->reload();
    }

    #[Computed(persist: true, seconds: 3600)]
    public function lists(): Collection
    {
        return app(GetUserSuggestions::class)->execute(
            user: $this->getAuthModel()
        )->collect();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function reload(): void
    {
        $this->clear();

        $this->fillPageScrollItems();

        $this->refresh();
    }

    public function populate(): void
    {
        unset($this->lists);

        $this->form->reset('list');

        $this->reload();
    }

    protected function getBuilder(): Builder
    {
        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form, user: $this->getAuthModel())
        );
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    protected function getScrollPageLimit(): ?int
    {
        return 24;
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
