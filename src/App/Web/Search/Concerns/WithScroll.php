<?php

namespace App\Web\Search\Concerns;

use Illuminate\Support\Sleep;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

trait WithScroll
{
    #[Locked]
    public array $items = [];

    public function mountWithScroll(): void
    {
        if (blank($this->items)) {
            $range = range(1, min(25, $this->items()->currentPage()));

            foreach ($range as $page) {
                $this->mergeItems(
                    $this->items($page)->all()
                );

                Sleep::for(100)->milliseconds();
            }
        }
    }

    public function updatedPage(): void
    {
        $this->mergeItems(
            $this->items()->all()
        );
    }

    #[Computed]
    public function onFirstPage(): bool
    {
        return $this->items()->onFirstPage();
    }

    #[Computed]
    public function onLastPage(): bool
    {
        return $this->items()->onLastPage();
    }

    protected function mergeItems(array $values = []): void
    {
        $this->items = array_merge_recursive(
            $this->items,
            $values,
        );
    }
}
