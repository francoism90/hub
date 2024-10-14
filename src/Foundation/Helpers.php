<?php

declare(strict_types=1);

use Illuminate\Support\Carbon;

if (! function_exists('duration')) {
    function duration(mixed $value): string
    {
        $time = Carbon::parse($value)
            ->utc()
            ->toTimeString();

        return preg_replace('/^0(?:0:0?)?/', '', $time);
    }
}
