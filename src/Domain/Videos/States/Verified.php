<?php

namespace Domain\Videos\States;

class Verified extends VideoState
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
