<?php

if (! function_exists('human_filesize')) {
    function human_filesize(mixed $size = 0, int $precision = 2): string
    {
        $size = floatval($size);

        $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        $step = 1024;

        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision).$units[$i];
    }
}
