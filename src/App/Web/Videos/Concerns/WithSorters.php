<?php

namespace App\Web\Videos\Concerns;

use Livewire\Attributes\Url;

trait WithSorters
{
    #[Url(history: true, as: 's')]
    public string $sort = '';

    public function hasSort(string $value): bool
    {
        return $this->sort === $value;
    }

    public function resetSort(): void
    {
        $this->reset('sort');
    }
}
