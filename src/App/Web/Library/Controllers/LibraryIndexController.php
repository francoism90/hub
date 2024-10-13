<?php

namespace App\Web\Library\Controllers;

use App\Web\Library\Forms\QueryForm;
use App\Web\Library\Scopes\FilterVideos;
use Domain\Playlists\Actions\GenerateUserFeed;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class LibraryIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function boot(): void
    {

    }

    public function mount(): void
    {
        app(GenerateUserFeed::class)->execute($this->getAuthModel());

        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.library.index')->with([
            'types' => $this->getTypes(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->validate();
    }

    public function updatedPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true)]
    public function items(): Paginator
    {
        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form)
        )->simplePaginate(24);
    }

    public function setType(string $type = ''): void
    {
        $this->form->type = $type;

        $this->submit();
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->refresh();

        $this->resetPage();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTypes(): array
    {
        return [
            ['key' => '', 'label' => __('All')],
            ['key' => 'untagged', 'label' => __('Untagged')],
            ['key' => 'new', 'label' => __('New to you')],
        ];
    }

    protected function getTitle(): ?string
    {
        return __('Library');
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch videos');
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
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
