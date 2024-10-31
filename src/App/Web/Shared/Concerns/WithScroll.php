<?php

declare(strict_types=1);

namespace App\Web\Shared\Concerns;

use Foxws\WireUse\Views\Concerns\WithRateLimiter;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

trait WithScroll
{
    use WithRateLimiter;

    #[Locked]
    public Collection $models;

    #[Locked]
    public int $fetchCount = 0;

    public function bootWithScroll(): void
    {
        data_set($this, 'models', collect(), false);
    }

    public function mountWithScroll(): void
    {
        if ($this->models->isEmpty()) {
            $this->fetch();
        }
    }

    #[Computed(persist: true, seconds: 3600)]
    public function items(): Collection
    {
        return $this->models;
    }

    /**
     * This will fetch and merge the items.
     */
    public function fetch(): void
    {
        $items = $this->getMergeCandidates();

        if ($items->isNotEmpty()) {
            $this->mergeScrollItems($items);
        }

        $this->fetchCount++;
    }

    /**
     * This will release the current items cache.
     */
    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    /**
     * This should be called to clear the model instances.
     */
    public function clear(): void
    {
        $this->reset('fetchCount');

        $this->models = collect();

        unset($this->items);
    }

    /**
     * This should be called to merge the model instances.
     */
    protected function mergeScrollItems(Collection $items): void
    {
        $items = $items
            ->take($this->getCandidatesLimit())
            ->filter()
            ->all();

        $this->models = $this->models
            ->merge($items)
            ->unique($this->getItemsUniqueKey());

        $this->refresh();
    }

    /**
     * This should return the model instances that will be merged.
     */
    protected function getMergeCandidates(): Collection
    {
        return collect();
    }

    /**
     * This will ensure that the items are unique, to prevent any Livewire key conflicts.
     */
    protected function getItemUniqueKey(): ?string
    {
        return 'id';
    }

    /**
     * This a limit that will used when fetching and merging items.
     */
    protected function getCandidatesLimit(): int
    {
        return 16;
    }

    /**
     * How many times it is possible to call fetch.
     */
    protected function getFetchLimits(): ?int
    {
        return null;
    }
}
