<?php

declare(strict_types=1);

namespace Domain\Transcodes\Exceptions;

use Exception;

class ExpiredTranscodeException extends Exception
{
    public static function make(): self
    {
        return new self('The transcode has expired and is no longer available.');
    }
}
