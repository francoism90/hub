<?php

namespace Domain\Users\States;

class Failed extends UserState
{
    public static $name = 'failed';

    public function label(): string
    {
        return __('Failed');
    }

    public function color(): string
    {
        return 'red';
    }
}
