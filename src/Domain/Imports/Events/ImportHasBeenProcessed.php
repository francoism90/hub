<?php

declare(strict_types=1);

namespace Domain\Imports\Events;

use Domain\Imports\Models\Import;
use Illuminate\Queue\SerializesModels;

class ImportHasBeenProcessed
{
    use SerializesModels;

    public function __construct(
        public Import $import,
    ) {}
}
