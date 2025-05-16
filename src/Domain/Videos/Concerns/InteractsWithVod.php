<?php

declare(strict_types=1);

namespace Domain\Videos\Concerns;

use Domain\Media\Models\Media;
use Domain\Videos\Actions\GetManifestUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Number;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

trait InteractsWithVod
{
    public function getClipCollection(): MediaCollection
    {
        return $this->getMedia('clips')->sortBy([
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        ]);
    }

    public function getCaptionCollection(): MediaCollection
    {
        return $this->getMedia('captions');
    }

    public function getPreviewCollection(): MediaCollection
    {
        return $this->getMedia('previews')->sortBy([
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->height', 'desc'],
            ['custom_properties->width', 'desc'],
        ]);
    }

    public function hasCaptions(): bool
    {
        if ($this->getCaptionCollection()->isNotEmpty()) {
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

        return (float) $media?->getCustomProperty('duration') ?: 0;
    }

    public function timeCode(): float
    {
        if (! auth()->check()) {
            return 0;
        }

        $timeCode = (float) $this->modelCached('timecode', 0);

        return Number::clamp($timeCode, 0, $this->duration);
    }

    protected function clips(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getClipCollection()
        )->shouldCache();
    }

    protected function captions(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getCaptionCollection()
        )->shouldCache();
    }

    protected function previews(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getPreviewCollection()
        )->shouldCache();
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

    public function stream(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, config('vod.format'), live: false)
        )->shouldCache();
    }

    public function preview(): Attribute
    {
        return Attribute::make(
            get: fn () => app(GetManifestUrl::class)->execute($this, config('vod.format'), live: true)
        )->shouldCache();
    }

    public function download(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('clips')->getTemporaryUrl(now()->addHours(3))
        )->shouldCache();
    }

    public function fileSize(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->clips?->totalSizeInBytes(),
        )->shouldCache();
    }
}
