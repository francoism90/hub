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

    public function updated(): void
    {
        $this->validate();

        $this->storeQuery();
    }

    #[Computed]
    public function queries(): Collection
    {
        return collect(session('queries', []))
            ->filter()
            ->unique()
            ->slice(0, 5);
    }

    #[Computed]
    public function videos(): Collection
    {
        return Video::query()
            ->with('tags')
            ->search((string) $this->form->query)
            ->take(5)
            ->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        return Tag::query()
            ->search((string) $this->form->query)
            ->take(5)
            ->get();
    }

    public function removeQuery(string $query = null): void
    {
        session()->put('queries', $this->queries()->reject($query));

        $this->reset('form.query');
    }

    protected function storeQuery(): void
    {
        if (blank($this->form->query)) {
            return;
        }

        $queries = $this->queries()
            ->prepend($this->form->query)
            ->filter()
            ->unique()
            ->slice(0, 5);

        session()->put('queries', $queries);
    }
}
