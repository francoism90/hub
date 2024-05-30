<?php

namespace App\Profile\Http\Controllers;

use App\Livewire\Discover\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class DiscoverController extends Page
{
    use WithAuthentication;
    use WithPagination;
    use WithQueryBuilder;

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('livewire.app.discover.index');
    }

    public function updated(): void
    {
        $this->form->submit();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    #[Computed]
    public function items(): Paginator
    {
        $value = $this->form->query();

        return $this->getScout($value)
            ->when(blank($value), fn (Builder $query) => $query->whereIn('id', [0]))
            ->simplePaginate(12 * 3);
    }

    protected function getTitle(): string
    {
        return __('Discover');
    }

    protected function getDescription(): string
    {
        return __('Discover');
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
