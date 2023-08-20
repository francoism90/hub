<?php

namespace Support\MediaLibrary\UrlGenerator;

use DateTimeInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class DefaultUrlGenerator extends BaseUrlGenerator
{
    public function getUrl(): string
    {
        return URL::route(
            'api.media.download',
            [
                'media' => $this->media,
                'version' => $this->media?->updated_at?->timestamp,
            ]
        );
    }

    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return URL::route(
            'api.media.download',
            $expiration,
            [
                'media' => $this->media,
                'version' => $this->media?->updated_at?->timestamp,
            ]
        );
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        return Str::finish(URL::route(
            'api.media.responsive',
            [
                'media' => $this->media,
            ]
        ), '/');
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
