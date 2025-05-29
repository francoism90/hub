<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Videos\Algos\GenerateUserSuggestions;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithPaginateScroll;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

class VideoIndexController extends Page
{
    use WithoutUrlPagination;
    use WithPaginateScroll;

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

        $this->clear();

        $this->fetch();
    }

    #[Computed(persist: true, seconds: 60 * 30)]
    public function lists(): Collection
    {
        $algo = GenerateUserSuggestions::make()
            ->forModel($this->getAuthModel())
            ->run();

        return $algo->get('items');
    }

    public function populate(): void
    {
        $this->form->reset('list');

        unset($this->lists);
    }

    protected function getBuilder(): Paginator
    {
        return $this->getQuery()
            ->tap(new FilterVideos($this->form, $this->getAuthModel(), $this->getCandidatesLimit()))
            ->simplePaginate(
                perPage: $this->getCandidatesLimit(),
                page: $this->getPage(),
            );
    }

    protected function getCandidatesLimit(): int
    {
        return 24;
    }

    protected function getFetchLimits(): ?int
    {
        return 32 * $this->getCandidatesLimit();
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
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
