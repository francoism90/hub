<?php

namespace Domain\Users\States;

class Failed extends UserState
{
    public function label(): string
    {
        return __('Failed');
    }

    public function color(): string
    {
        return 'red';
    }
}
