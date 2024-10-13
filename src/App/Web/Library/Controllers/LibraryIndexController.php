<?php

namespace App\Web\Library\Controllers;

use App\Web\Library\Forms\QueryForm;
use App\Web\Library\Scopes\FilterVideos;
use App\Web\Playlists\Concerns\WithPlaylists;
use Domain\Playlists\Actions\PopulateMixerPlaylist;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Videoable;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class LibraryIndexController extends Page
{
    use WithPagination;
    use WithPlaylists;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();

        $this->populateMixer();
    }

    public function render(): View
    {
        return view('app.library.index')->with([
            'mixers' => $this->getMixers(),
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

    #[Computed]
    public function items(): Paginator
    {
        return $this->getScout()->tap(
            new FilterVideos(form: $this->form)
        )->simplePaginate(24);
    }

    public function setType(string $type = ''): void
    {
        $this->form->type = $type;

        $this->form->submit();

        $this->populateMixer(true);

        $this->clear();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function clear(): void
    {
        $this->refresh();

        $this->resetPage();
    }

    protected function getTitle(): ?string
    {
        return __('Library');
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch videos');
    }

    protected function populateMixer(?bool $force = null): void
    {
        $model = $this->getMixer();

        $this->canUpdate($model);

        app(PopulateMixerPlaylist::class)->execute($model, $force);
    }

    protected function getMixer(): ?Playlist
    {
        return Playlist::query()
            ->mixer()
            ->where('user_id', $this->getAuthId())
            ->where('name', $this->form->type)
            ->first();
    }

    protected function getModelClass(): ?string
    {
        return Videoable::class;
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.playlist.trashed" => 'refresh',
            "echo-private:user.{$id},.playlist.updated" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
