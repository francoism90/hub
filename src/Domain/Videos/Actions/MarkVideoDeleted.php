<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class MarkVideoDeleted
{
    public function execute(Video $model): void
    {
        $model->deleteOrFail();
    }
}
