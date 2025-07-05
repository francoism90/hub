<?php

declare(strict_types=1);

namespace Domain\Transcodes\Concerns;

use Domain\Transcodes\Models\Transcode;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasTranscodes
{
    public function transcodes(): MorphMany
    {
        return $this->morphMany(Transcode::class, 'transcodeable')->chaperone();
    }

    public function latestTranscode(): MorphOne
    {
        return $this->morphOne(Transcode::class, 'transcodeable')->latestOfMany();
    }

    public function currentTranscode(): MorphOne
    {
        return $this->morphOne(Transcode::class, 'transcodeable')->ofMany([
            'expires_at' => 'max',
            'created_at' => 'max',
            'id' => 'max',
        ]);
    }
}
