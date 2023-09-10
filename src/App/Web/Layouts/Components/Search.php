<?php

namespace App\Web\Layouts\Components;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Search extends Component
{
    public ?string $query = null;

    public function mount(): void
    {
        $this->populateQuery();
    }

    public function render(): View
    {
        return view('layouts::search');
    }

    public function updatedQuery(): void
    {
        $this->storeQuery();
    }

    #[Computed]
    public function videos(): Collection
    {
        if (blank($this->query)) {
            return collect();
        }

        return Video::query()
            ->with('tags')
            ->search((string) $this->query)
            ->take(5)
            ->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        if (blank($this->query)) {
            return collect();
        }

        return Tag::query()
            ->search((string) $this->query)
            ->take(5)
            ->get();
    }

    protected function populateQuery(): void
    {
        $this->query = session('searchQuery');
    }

    protected function storeQuery(): void
    {
        session(['searchQuery' => $this->query]);
    }
}
