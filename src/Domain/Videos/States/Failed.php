<?php

namespace Domain\Videos\States;

class Failed extends VideoState
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
