<?php

declare(strict_types=1);

namespace Domain\Videos\Exceptions;

use Exception;

class VideoException extends Exception
{
    public static function emptyTranscodeCollection(): self
    {
        return new self('The given video has no transcodes.');
    }
}
