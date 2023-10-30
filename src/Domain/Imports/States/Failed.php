<?php

namespace Domain\Imports\States;

class Failed extends ImportState
{
    public static $name = 'failed';

    public function label(): string
    {
        return __('Failed');
    }

    public function icon(): string
    {
        return 'heroicon-o-x-circle';
    }

    public function color(): string
    {
        return 'danger';
    }
}
