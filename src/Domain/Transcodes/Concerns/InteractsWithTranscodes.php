<?php

declare(strict_types=1);

namespace Domain\Transcodes\Concerns;

use Domain\Transcodes\Models\Transcode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

trait InteractsWithTranscodes
{
    public static function bootInteractsWithTranscodes(): void
    {
        static::deleting(function (Model $model) {
            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (! $model->forceDeleting) {
                    return;
                }
            }

            $model->transcodes()->cursor()->each(fn (Transcode $transcode) => $transcode->delete());
        });
    }

    public function transcodes(): MorphMany
    {
        return $this->morphMany(Transcode::class, 'transcodeable')->chaperone();
    }

    public function currentTranscode(): ?Transcode
    {
        return $this->transcodes()->active()->first();
    }

    public function isTranscoding(): bool
    {
        return $this->transcodes()->pending()->exists();
    }
}
