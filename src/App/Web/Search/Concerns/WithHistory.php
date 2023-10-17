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

    protected function storeQueries(): void
    {
        // Filter search queries
        $queries = $this->queries()
            ->prepend($this->form->query ?: null)
            ->filter()
            ->unique()
            ->slice(0, 5);

        // Store search queries
        session()->put('queries', $queries);
    }
}
