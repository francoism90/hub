<?php

declare(strict_types=1);

namespace App\Web\Library\Controllers;

use App\Web\Groups\Concerns\WithGroups;
use App\Web\Library\Forms\QueryForm;
use App\Web\Library\Scopes\FilterVideos;
use Domain\Groups\Actions\PopulateMixerGroup;
use Domain\Groups\Models\Group;
use Domain\Videos\Models\Videoable;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class LibraryIndexController extends Page
{
    use WithGroups;
    use WithPagination;
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

    #[Computed(persist: true)]
    public function items(): Paginator
    {
        return $this->getQuery()->tap(
            new FilterVideos(form: $this->form)
        )->simplePaginate(12);
    }

    public function setType(string $type = ''): void
    {
        $this->form->type = $type;

        $this->form->submit();

        $this->populateMixer(force: true);

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
        return 'Stream Videos';
    }

    protected function getDescription(): ?string
    {
        return __('Browse and watch videos');
    }

    protected function populateMixer(?bool $force = null): void
    {
        $model = $this->getMixer();

        $this->canUpdate($model);

        app(PopulateMixerGroup::class)->execute($model, $force);
    }

    protected function getMixer(): ?Group
    {
        return Group::query()
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
