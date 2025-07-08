<?php

declare(strict_types=1);

namespace Domain\Transcodes\Models;

use Domain\Transcodes\Collections\TranscodeCollection;
use Domain\Transcodes\Observers\TranscodeObserver;
use Domain\Transcodes\QueryBuilders\TranscodeQueryBuilder;
use Domain\Transcodes\Scopes\OrderedScope;
use Domain\Users\Concerns\InteractsWithUser;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(TranscodeObserver::class)]
#[ScopedBy(OrderedScope::class)]
class Transcode extends Model
{
    use HasFactory;
    use HasUlids;
    use InteractsWithUser;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'transcodeable_type',
        'transcodeable_id',
        'disk',
        'file_name',
        'collection',
        'expires_at',
        'finished_at',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function newEloquentBuilder($query): TranscodeQueryBuilder
    {
        return new TranscodeQueryBuilder($query);
    }

    public function newCollection(array $models = []): TranscodeCollection
    {
        return new TranscodeCollection($models);
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function transcodeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getDisk(): string
    {
        return $this->disk ?? config('transcode.disk_name');
    }

    public function getPath(): string
    {
        return (string) $this->getKey();
    }

    public function getFilesystem(): FilesystemAdapter
    {
        return Storage::disk($this->getDisk());
    }

    public function getAbsolutePath(): string
    {
        return $this->getFilesystem()->path($this->getPath());
    }

    public static function getSegmentLength(): int
    {
        return config('transcode.segment_length', 10);
    }

    public static function getFrameInterval(): int
    {
        return config('transcode.frame_interval', 48);
    }

    public static function getKiloBitrate(): int
    {
        return config('transcode.kilo_bitrate', 1500);
    }

    public static function getPasses(): int
    {
        return config('transcode.passes', 1);
    }

    public static function getAdditionalParameters(): array
    {
        return config('transcode.additional_parameters', []);
    }

    public static function getDestinationDisk(): string
    {
        return config('transcode.disk_name', 'transcode');
    }

    public static function getVideoFormats(): Collection
    {
        return collect(config('transcode.video_formats', []))
            ->filter(fn (string $format) => is_subclass_of($format, DefaultVideo::class))
            ->map(fn (string $format) => app($format));
    }

    public static function getExpiresAfter(): ?Carbon
    {
        $expires = config('transcode.expires_after');

        return $expires === null ? null : Carbon::now()->addSeconds($expires);
    }

    public static function copyVideoCodec(): bool
    {
        return config('transcode.copy_video_codec', true);
    }

    public static function copyAudioCodec(): bool
    {
        return config('transcode.copy_audio_codec', true);
    }
}
