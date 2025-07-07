<?php

declare(strict_types=1);

namespace Support\MediaLibrary\UrlGenerator;

use DateTimeInterface;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator as BaseUrlGenerator;

class DefaultUrlGenerator extends BaseUrlGenerator
{
    public function getUrl(): string
    {
        return route('api.media.asset', [
            'media' => $this->media,
            'conversion' => $this->conversion?->getName(),
            'version' => $this->media?->updated_at?->getTimestamp(),
        ]);
    }

    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return route('api.media.download', [
            'media' => $this->media,
            'conversion' => $this->conversion?->getName(),
            'version' => $this->media?->updated_at?->getTimestamp(),
        ]);
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        $url = route('api.media.responsive', [
            'media' => $this->media,
            'conversion' => $this->conversion?->getName(),
        ]);

        return str($url)->finish('/')->value();
    }
}
