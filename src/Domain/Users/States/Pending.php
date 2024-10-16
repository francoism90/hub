<?php

declare(strict_types=1);

namespace Domain\Users\States;

class Pending extends UserState
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
