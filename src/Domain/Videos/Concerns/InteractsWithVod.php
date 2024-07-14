<?php

namespace Domain\Videos\Concerns;

use Domain\Media\Models\Media;
use Domain\Videos\Actions\GetManifestUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

trait InteractsWithVod
{
    public function clips(): MediaCollection
    {
        return $this->getMedia('clips')->sortBy([
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        ]);
    }

    public function captions(): MediaCollection
    {
        return $this->getMedia('captions');
    }

    public function previews(): MediaCollection
    {
        return $this->getMedia('previews')->sortBy([
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        ]);
    }

    public function hasCaptions(): bool
    {
        if ($this->captions()->count()) {
            return true;
        }

        return $this
            ->getMedia('clips')
            ->filter(fn (Media $media) => $media->getCustomProperty('closed_captions', false))
            ->isNotEmpty();
    }

    public function durationInSeconds(): float
    {
        $media = $this
            ->getMedia('clips')
            ->sortByDesc(fn (Media $media) => $media->getCustomProperty('duration', 0))
            ->first();

        return $media?->getCustomProperty('duration') ?: 0;
    }

    protected function caption(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hasCaptions()
        )->shouldCache();
    }

    protected function duration(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->durationInSeconds()
        )->shouldCache();
    }

    public function preview(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, 'preview')
        )->shouldCache();
    }

    public function stream(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, 'stream')
        )->shouldCache();
    }

    public function download(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('clips')
        )->shouldCache();
    }
}
