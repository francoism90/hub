<?php

namespace Domain\Videos\Observers;

use Domain\Videos\Models\Videoable;

final readonly class VideoableObserver
{
    public function attached(Videoable $model): void
    {
        logger('attached');
    }

    public function detached(Videoable $model): void
    {
        logger('detached');
    }

    public function created(Videoable $model): void
    {
        logger('created');
        logger($model->searchable());
    }

    public function updated(Videoable $model): void
    {
        logger('updated');
    }

    public function deleted(Videoable $model): void
    {
        logger('deleted');
    }
}
