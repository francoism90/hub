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
        return $this->getMedia('clips')->sortByDesc(
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        );
    }

    public function captions(): MediaCollection
    {
        return $this->getMedia('captions');
    }

    public function previews(): MediaCollection
    {
        return $this->getMedia('previews')->sortByDesc(
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        );
    }

    protected function closedCaptions(): Attribute
    {
        return Attribute::make(function () {
            if ($this->captions()->count()) {
                return true;
            }

            return $this
                ->getMedia('clips')
                ->filter(fn (Media $media) => $media->getCustomProperty('closed_captions', false))
                ->isNotEmpty();
        })->shouldCache();
    }

    protected function duration(): Attribute
    {
        return Attribute::make(function () {
            $media = $this
                ->getMedia('clips')
                ->sortByDesc(fn (Media $media) => $media->getCustomProperty('duration', 0))
                ->first();

            return $media?->getCustomProperty('duration') ?: 0;
        })->shouldCache();
    }

    public function preview(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, 'preview')
        )->withoutObjectCaching();
    }

    public function stream(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, 'stream')
        )->withoutObjectCaching();
    }
}
