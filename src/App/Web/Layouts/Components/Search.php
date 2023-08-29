<?php

namespace App\Web\Layouts\Components;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Search extends Component
{
    public ?string $search = null;

    public function render(): View
    {
        return view('layouts::search', [
            'videos' => $this->videos(),
            'tags' => $this->tags(),
        ]);
    }

    #[Computed]
    public function videos(): Collection
    {
        if (blank($this->search)) {
            return collect();
        }

        return Video::query()
            ->with('tags')
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(5)
            ->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        if (blank($this->search)) {
            return collect();
        }

        return Tag::query()
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(5)
            ->get();
    }
}
