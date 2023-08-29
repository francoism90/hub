<?php

namespace App\Web\Account\Controllers;

use App\Web\Videos\Concerns\WithVideos;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryController extends Component
{
    use WithVideos;
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = '';

    public function mount(): void
    {
        SEOMeta::setTitle(__('History'));
    }

    public function render(): View
    {
        return view('account::history', [
            'items' => $this->builder(),
        ]);
    }

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }

    protected function builder(): Paginator
    {
        return Video::query()
            ->with('tags')
            ->history()
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->orderByDesc('created_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
