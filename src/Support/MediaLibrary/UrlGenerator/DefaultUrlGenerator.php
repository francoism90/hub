<?php

declare(strict_types=1);

namespace Support\MediaLibrary\UrlGenerator;

use DateTimeInterface;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class DefaultUrlGenerator extends BaseUrlGenerator
{
    public function getUrl(): string
    {
        return route('api.media.asset', [
            'media' => $this->media,
            'conversion' => $this->conversion,
            'version' => $this->media?->updated_at?->getTimestamp(),
        ]);
    }

    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return route('api.media.download', [
            'media' => $this->media,
            'conversion' => $this->conversion,
            'version' => $this->media?->updated_at?->getTimestamp(),
        ]);
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        $url = route('api.media.responsive', [
            'media' => $this->media,
            'conversion' => $this->conversion,
        ]);

        return str($url)->finish('/')->value();
    }

    public function getBaseMediaDirectoryUrl(): string
    {
        return $this->getDisk()->url('/');
    }

    public function getPath(): string
    {
        return $this->getRootOfDisk().$this->getPathRelativeToRoot();
    }

    protected function getRootOfDisk(): string
    {
        return $this->getDisk()->path('/');
    }
}
