<?php

namespace Domain\Users\States;

class Verified extends UserState
{
    public function label(): string
    {
        return __('Verified');
    }

    public function color(): string
    {
        return 'green';
    }
}
