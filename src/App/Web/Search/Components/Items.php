<?php

namespace App\Web\Search\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Items extends Component
{
    public function __construct(
        public Paginator $items,
        public string $sort,
    ) {
    }

    public function render(): View
    {
        return view('search::items');
    }

    public function sorters(): Collection
    {
        return collect([
            '' => __('Relevance'),
            'released' => __('Released'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
        ]);
    }

    public function sorter(): ?string
    {
        $sorters = $this->sorters();

        return $sorters->first(
            fn (string $value, string $key) => $key === $this->sort,
            fn () => $sorters->first(),
        );
    }
}
