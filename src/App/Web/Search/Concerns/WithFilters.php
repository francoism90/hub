<?php

namespace App\Web\Search\Concerns;

use Livewire\Attributes\Computed;

trait WithFilters
{
    #[Computed]
    public function sorters(): array
    {
        return [
            '' => __('Relevance'),
            'released'  => __('Released'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
        ];
    }

    #[Computed]
    public function sorter(): string
    {
        $sorters = collect($this->sorters);

        return $sorters->first(
            fn (string $value, string $key) => $key === $this->form->sort,
            fn () => $sorters->first(),
        );
    }

    public function hasSort(string $sorter): bool
    {
        return $this->form->sort === $sorter;
    }
}
