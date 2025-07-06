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

    public function currentTranscode(): ?Transcode
    {
        return $this->transcodes()->active()->first();
    }
}
