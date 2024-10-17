<?php

declare(strict_types=1);

namespace Domain\Groups\DataObjects;

use Spatie\LaravelData\Data;

class GroupData extends Data
{
    public function __construct(
        public ?int $tag = null,
    ) {}
}
