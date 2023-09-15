<?php

namespace App\Web\Search\Concerns;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

trait WithScroll
{
    #[Locked]
    public array $items = [];

    public function mountWithScroll(): void
    {
        $this->populate();
    }

    public function updatedPage(): void
    {
        $this->populate();
    }

    protected function populate(): void
    {
        if (blank($this->items)) {
            $range = range(1, $this->builder()->currentPage());

            foreach ($range as $page) {
                $this->mergeItems(
                    $this->builder($page)->all()
                );
            }
        }
    }

    #[Computed]
    public function onFirstPage(): bool
    {
        return $this->builder()->onFirstPage();
    }

    #[Computed]
    public function onLastPage(): bool
    {
        return $this->builder()->onLastPage();
    }

    protected function mergeItems(array $values): void
    {
        $this->items = array_merge_recursive(
            $this->items,
            $values,
        );
    }
}
