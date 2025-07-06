<?php

declare(strict_types=1);

namespace Domain\Media\Actions;

use Closure;
use Domain\Media\Models\Media;
use FFMpeg\FFProbe\DataMapping\Stream;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class SetMediaProperties
{
    public function __invoke(Media $media, Closure $next): mixed
    {
        return DB::transaction(function () use ($media, $next) {
            $keys = $this->getStreamKeys();

            if (! str($media->mime_type)->startsWith('audio/', 'video/')) {
                return;
            }

            $streams = $this->parseStreams($media, $keys);

            $media->setCustomProperty('streams', $streams->toArray());
            $media->saveOrFail();

            return $next($media);
        });
    }

    protected function parseStreams(Media $media, array $keys): Collection
    {
        $streams = FFMpeg::fromDisk($media->disk)
            ->open($media->getPathRelativeToRoot())
            ->getStreams();

        return collect($streams)
            ->map(fn (Stream $stream) => collect($stream->all())->only($keys)->toArray())
            ->filter();
    }

    protected function getStreamKeys(): array
    {
        return [
            'index',
            'codec_name',
            'codec_type',
            'width',
            'height',
            'bit_rate',
            'sample_rate',
            'duration',
            'closed_captions',
            'channels',
            'channel_layout',
        ];
    }
}
