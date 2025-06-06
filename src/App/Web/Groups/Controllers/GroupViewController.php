<?php

declare(strict_types=1);

namespace App\Web\Groups\Controllers;

use App\Web\Groups\Concerns\WithGroup;
use App\Web\Groups\Forms\QueryForm;
use App\Web\Groups\Scopes\FilterVideos;
use Domain\Groups\Enums\GroupSet;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class GroupViewController extends Page
{
    use WithGroup;
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.groups.view')->with([
            'title' => $this->getTitle(),
            'types' => $this->getTypes(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->submit();
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this->getGroup()
            ->videos()
            ->tap(new FilterVideos(form: $this->form, group: $this->group))
            ->simplePaginate(perPage: 24);
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->resetPage();
    }

    public function blank(): void
    {
        $this->form->reset();

        $this->form->forget();

        $this->submit();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function delete(): void
    {
        $this->canDelete($this->getGroup());

        $this->getGroup()->deleteOrFail();

        $this->refresh();
    }

    public function clear(): void
    {
        $this->canUpdate($this->getGroup());

        $this->getGroup()->videos()->detach();

        $this->refresh();
    }

    protected function getTypes(): array
    {
        return [
            GroupSet::Newest,
            GroupSet::Oldest,
            GroupSet::Recommended,
        ];
    }

    protected function getTitle(): ?string
    {
        return (string) $this->group->name;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->group->content;
    }

    protected function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getGroupListeners(),
        ];
    }
}
