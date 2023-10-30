<?php

namespace Domain\Videos\States;

class Pending extends VideoState
{
    public static $name = 'pending';

    public function label(): string
    {
        return __('Pending');
    }

    public function icon(): string
    {
        return 'heroicon-o-minus-circle';
    }

    public function color(): string
    {
        return 'gray';
    }
}
