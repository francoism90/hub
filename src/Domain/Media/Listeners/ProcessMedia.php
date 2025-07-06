<?php

declare(strict_types=1);

namespace Domain\Media\Listeners;

use Domain\Media\Actions\SetMediaProperties;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Pipeline;
use Spatie\MediaLibrary\Conversions\Events\ConversionWillStartEvent;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class ProcessMedia implements ShouldQueue
{
    use InteractsWithQueue;

    public function __invoke(MediaHasBeenAddedEvent|ConversionWillStartEvent $event): void
    {
        Pipeline::send($event->media)
            ->through([
                SetMediaProperties::class,
            ])
            ->thenReturn();
    }

    public function viaQueue(): string
    {
        return 'processing';
    }
}
