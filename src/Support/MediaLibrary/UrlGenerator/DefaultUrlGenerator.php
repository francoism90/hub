<?php

namespace Support\MediaLibrary\UrlGenerator;

use DateTimeInterface;
use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class DefaultUrlGenerator extends BaseUrlGenerator
{
    public function getUrl(): string
    {
        return URL::signedRoute('api.media.asset', [
            'media' => $this->media,
            'version' => $this->media?->updated_at?->timestamp,
        ]);
    }

    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return URL::temporarySignedRoute('api.media.asset', $expiration, [
            'media' => $this->media,
            'version' => $this->media?->updated_at?->timestamp,
        ]);
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        $url = route('api.media.responsive', [
            'media' => $this->media,
        ]);

        return str($url)->finish('/');
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
