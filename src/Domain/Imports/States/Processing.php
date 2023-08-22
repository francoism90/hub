<?php

namespace Domain\Imports\States;

class Processing extends ImportState
{
    public static $name = 'processing';

    public function label(): string
    {
        return __('Processing');
    }

    public function color(): string
    {
        return 'purple';
    }
}
