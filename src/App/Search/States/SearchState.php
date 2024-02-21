<?php

namespace App\Search\States;

use Foxws\LivewireUse\Support\Livewire\StateObjects\State;

class SearchState extends State
{
    public function sorters(): array
    {
        return [
            '' => __('Relevance'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
            'released' => __('Released'),
        ];
    }
}
