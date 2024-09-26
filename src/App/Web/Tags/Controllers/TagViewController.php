<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\QueryForm;
use App\Web\Tags\Scopes\FilterVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class TagViewController extends Page
{
    use WithPagination;
    use WithQueryBuilder;
    use WithTag;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.tags.view')->with([
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
        $builder = $this->form->blank('type', 'sort')
            ? $this->getQueryBuilder()
            : $this->getScoutBuilder();

        return $builder->simplePaginate(12 * 4);
    }

    public function setType(string $type = ''): void
    {
        $this->authorize('viewAny', $this->getModelClass());

        $this->form->type = $type;

        $this->submit();
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->refresh();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function onTagUpdated(): void
    {
        $this->refresh();
    }

    protected function getScoutBuilder(): Builder
    {
        return $this->getScout()->tap(
            new FilterVideos(form: $this->form, tag: $this->tag),
        );
    }

    protected function getQueryBuilder(): MorphToMany
    {
        return $this
            ->getTag()
            ->videos()
            ->tagged(60 * 60 * 24);
    }

    protected function getTypes(): array
    {
        return [
            ['key' => '', 'label' => __('Recommended')],
            ['key' => 'recent', 'label' => __('Latest')],
            ['key' => 'longest', 'label' => __('Longest')],
        ];
    }

    protected function getTitle(): ?string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->tag->description;
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
