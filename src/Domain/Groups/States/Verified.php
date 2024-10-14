<?php

namespace Domain\Groups\States;

class Verified extends GroupState
{
    public static $name = 'verified';

    public function label(): string
    {
        return __('Verified');
    }

    public function color(): string
    {
        return 'green';
    }
}
