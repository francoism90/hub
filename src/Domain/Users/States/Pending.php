<?php

namespace Domain\Users\States;

class Pending extends UserState
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
