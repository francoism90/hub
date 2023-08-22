<?php

namespace Domain\Videos\States;

class Verified extends VideoState
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
