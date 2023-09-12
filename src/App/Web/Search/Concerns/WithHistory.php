<?php

namespace App\Web\Search\Concerns;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

trait WithHistory
{
    #[Computed]
    public function queries(): Collection
    {
        return collect(session('queries', []))
            ->filter()
            ->unique()
            ->slice(0, 5);
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
        session()->put('search', $this->form->toArray());
    }
}
