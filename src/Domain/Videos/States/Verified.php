<?php

declare(strict_types=1);

namespace Domain\Videos\States;

class Verified extends VideoState
{
    public static $name = 'verified';

    public function label(): string
    {
        return __('Verified');
    }

    public function icon(): string
    {
        return 'heroicon-o-check-circle';
    }

    public function color(): string
    {
        return 'primary';
    }
}
