<?php

namespace App\Videos\Controllers;

use App\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Concerns\WithQueryBuilder;
use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    #[Url(as: 'q', history: true, except: '')]
    public string $search = '';

    #[Url(as: 't', history: true, except: [])]
    public array $tags = [];

    public QueryForm $form;

    public function mount(): void
    {
        $this->populate();
    }

    public function render(): View
    {
        return view('videos.index');
    }

    public function updated(): void
    {
        $this->populate();

        $this->resetPage();
    }

    public function populate(): void
    {
        $this->form->fill(
            $this->only('search', 'tags')
        );

        if ($this->form->fails()) {
            $this->clear();
        }

        $this->form->submit();
    }

    public function clear(): void
    {
        $this->form->clear();

        $this->redirect(static::class, navigate: true);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this->getQuery()
            ->published()
            ->when($this->form->blank('search', 'tags'), fn (Builder $query) => $query->recommended())
            ->when($this->form->getSearch(), fn (Builder $query, string $value) => $query->search($value))
            ->when($this->form->getTags(), fn (Builder $query, array $value) => $query->tagged($value))
            ->simplePaginate(32);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
