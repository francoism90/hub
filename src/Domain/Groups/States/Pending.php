<?php

namespace Domain\Groups\States;

class Pending extends GroupState
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
