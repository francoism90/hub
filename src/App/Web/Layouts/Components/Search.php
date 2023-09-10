<?php

namespace App\Web\Layouts\Components;

use App\Web\Layouts\Forms\SearchForm;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Search extends Component
{
    public SearchForm $form;

    public function render(): View
    {
        return view('layouts::search');
    }

    public function updated($name, $value): void
    {
        $this->validate();
    }

    #[Computed]
    public function videos(): Collection
    {
        $query = $this->form->query;

        if (blank($query)) {
            return collect();
        }

        return Video::query()
            ->with('tags')
            ->search((string) $query)
            ->take(5)
            ->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        $query = $this->form->query;

        if (blank($query)) {
            return collect();
        }

        return Tag::query()
            ->search((string) $query)
            ->take(5)
            ->get();
    }
}
