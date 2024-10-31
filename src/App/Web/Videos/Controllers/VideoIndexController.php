<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Shared\Concerns\WithScroll;
use App\Web\Videos\Forms\QueryForm;
use Domain\Videos\Algos\GenerateUserFeed;
use Domain\Videos\Algos\GenerateUserSuggestions;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    use WithAuthentication;
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

        $this->fetch();

        $this->refresh();
    }

    #[Computed(persist: true, seconds: 3600)]
    public function lists(): Collection
    {
        $algo = GenerateUserSuggestions::make()
            ->model($this->getAuthModel())
            ->run();

        return $algo->meta['items'];
    }

    public function populate(): void
    {
        $this->form->reset('list');

        unset($this->lists);
    }

    protected function getMergeCandidates(): Collection
    {
        $candidateIds = $this->generateCandidates();

        return $this->getQuery()
            ->whereIn('id', $candidateIds)
            ->get()
            ->sortBy(fn (Video $video) => array_search($video->getKey(), $candidateIds));
    }

    protected function generateCandidates(): array
    {
        $algo = GenerateUserFeed::make()
            ->model($this->getAuthModel())
            ->run();

        return $algo->meta['ids']->toArray();
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
