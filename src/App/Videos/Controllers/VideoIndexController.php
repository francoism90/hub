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
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    public function updated(): void
    {
        $this->getModel()::forgetRandomSeed('feed');

        $this->refresh();

        $this->form->submit();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->refresh();

        $this->form->clear();
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
            ->when($this->form->get('tags'), fn (Builder $query, array $value) => $query->tagged($value))
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
