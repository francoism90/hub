<?php

declare(strict_types=1);

namespace Domain\Transcodes\Concerns;

use Domain\Transcodes\Models\Transcode;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTranscodes
{
    public function transcodes(): MorphMany
    {
        return $this->morphMany(Transcode::class, 'transcodeable')->chaperone();
    }

    public function hasBeenTranscoded(): bool
    {
        /** @var Transcode $current */
        $current = $this->currentTranscode();

        return $current->finished_at?->isPast() && $current->expires_at?->isFuture();
    }
}
