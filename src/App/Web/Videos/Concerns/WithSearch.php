<?php

namespace App\Web\Videos\Concerns;

use Livewire\Attributes\Url;

trait WithSearch
{
    #[Url(history: true, as: 'q')]
    public string $query = '';

    public function hasSearch(): bool
    {
        return filled($this->query);
    }

    public function resetSearch(): void
    {
        $this->reset('query');
    }
}
