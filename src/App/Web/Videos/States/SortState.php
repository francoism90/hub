<?php

namespace App\Web\Videos\States;

use Foxws\LivewireUse\Support\StateObjects\State;

class SortState extends State
{
    public function sorters(): array
    {
        return [
            '' => __('Default'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
            'released' => __('Released'),
        ];
    }
}
