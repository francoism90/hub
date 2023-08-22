<?php

namespace Domain\Imports\States;

class Pending extends ImportState
{
    public static $name = 'pending';

    public function label(): string
    {
        return __('Pending');
    }

    public function color(): string
    {
        return 'orange';
    }
}
