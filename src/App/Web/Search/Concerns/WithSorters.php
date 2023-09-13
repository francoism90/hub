<?php

namespace App\Web\Search\Concerns;

use Livewire\Attributes\Computed;

trait WithSorters
{
    #[Computed]
    public function sorters(): array
    {
        return [
            '' => __('Relevance'),
            'released' => __('Released'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
        ];
    }

    #[Computed]
    public function sorter(): string
    {
        $items = collect($this->sorters);

        return $items->first(
            fn (string $value, string $key) => $key === $this->form->sort,
            fn () => $items->first(),
        );
    }

    public function hasSort(string $value): bool
    {
        return (string) $this->form->sort === $value;
    }
}
