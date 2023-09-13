<?php

namespace App\Web\Videos\Concerns;

trait WithFilters
{
    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search', 'sort', 'tag', 'type']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }
}
