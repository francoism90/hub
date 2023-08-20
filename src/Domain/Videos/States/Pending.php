<?php

namespace Domain\Videos\States;

class Pending extends VideoState
{
    public function label(): string
    {
        return __('Pending');
    }

    public function color(): string
    {
        return 'orange';
    }
}
