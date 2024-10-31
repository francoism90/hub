<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Shared\Concerns\WithScroll;
use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\Scopes\FilterVideos;
use Domain\Groups\Actions\GetUserSuggestions;
use Domain\Videos\Algos\GenerateUserFeed;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    use WithAuthentication;
    use WithQueryBuilder;
    use WithScroll;

    protected static int $maxAttempts = 0;

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

        $this->refresh();

        $this->fetch();
    }

    #[Computed(persist: true, seconds: 3600)]
    public function lists(): Collection
    {
        return app(GetUserSuggestions::class)->execute(
            user: $this->getAuthModel()
        )->collect();
    }

    public function populate(): void
    {
        unset($this->lists);

        $this->form->reset('list');

        $this->refresh();

        $this->fetch();
    }

    protected function getBuilder(): Builder
    {
        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form, user: $this->getAuthModel())
        );
    }

    protected function getMergeCandidates(): Collection
    {
        $candidates = $this->generateCandidates();

        return $this->getQuery()
            ->whereIn('id', $candidates->ids)
            ->get()
            ->sortBy(fn (Video $video) => array_search($video->getKey(), $candidates->ids));
    }

    protected function generateCandidates(): Fluent
    {
        $algo = GenerateUserFeed::make()
            ->model($this->getAuthModel())
            ->run();

        return fluent(Video::modelClassCached($algo->meta['hash']));
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
