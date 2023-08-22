<?php

namespace Domain\Imports\States;

class Finished extends ImportState
{
    public static $name = 'finished';

    public function label(): string
    {
        return __('Successful');
    }

    public function color(): string
    {
        return 'green';
    }
}
