<?php

namespace Domain\Imports\States;

class Finished extends ImportState
{
    public static $name = 'finished';

    public function label(): string
    {
        return __('Finished');
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
