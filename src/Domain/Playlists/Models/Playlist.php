<?php

declare(strict_types=1);

namespace Domain\Playlists\Models;

use Domain\Playlists\Collections\PlaylistCollection;
use Domain\Playlists\Observers\PlaylistObserver;
use Domain\Playlists\QueryBuilders\PlaylistQueryBuilder;
use Domain\Playlists\Scopes\OrderedScope;
use Domain\Users\Concerns\InteractsWithUser;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[ObservedBy(PlaylistObserver::class)]
#[ScopedBy(OrderedScope::class)]
class Playlist extends Model
{
    use HasFactory;
    use HasUlids;
    use InteractsWithUser;
    use Prunable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'playlistable_type',
        'playlistable_id',
        'disk',
        'file_name',
        'collection',
        'expires_at',
        'transcoded_at',
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
            'transcoded_at' => 'datetime',
        ];
    }

    public function newEloquentBuilder($query): PlaylistQueryBuilder
    {
        return new PlaylistQueryBuilder($query);
    }

    public function newCollection(array $models = []): PlaylistCollection
    {
        return new PlaylistCollection($models);
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function playlistable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getModel(): Model
    {
        return $this->playlistable;
    }

    public function getDisk(): string
    {
        return $this->disk ?? config('playlist.disk_name');
    }

    public function getPath(): string
    {
        return (string) $this->getKey();
    }

    public function getAbsolutePath(): string
    {
        return $this->getFilesystem()->path($this->getPath());
    }

    public function getFilesystem(): FilesystemAdapter
    {
        return Storage::disk($this->getDisk());
    }

    public function toResponse(?string $path = null): StreamedResponse
    {
        return $this->getFilesystem()->response(implode('/', [$this->getPath(), $path ?? $this->file_name]));
    }

    public function isExpired(): bool
    {
        return $this->expires_at?->isPast() ?? false;
    }

    public function isTranscoded(): bool
    {
        return $this->transcoded_at?->isPast() ?? false;
    }

    public function isActive(): bool
    {
        return ! $this->isExpired() && ! $this->isTranscoded();
    }

    public function prunable(): PlaylistQueryBuilder
    {
        return static::query()->expired();
    }

    public function assetUri(): Attribute
    {
        return Attribute::make(
            get: fn () => route('api.playlists.playlist', [$this, $this->file_name]),
        )->shouldCache();
    }

    public static function getSegmentLength(): int
    {
        return config('playlist.segment_length', 10);
    }

    public static function getFrameInterval(): int
    {
        return config('playlist.frame_interval', 48);
    }

    public static function getDestinationDisk(): string
    {
        return config('playlist.disk_name', 'playlist');
    }

    public static function getVideoFormats(): Collection
    {
        return collect(config('playlist.video_formats', []))
            ->filter(fn (string $format) => is_subclass_of($format, DefaultVideo::class))
            ->map(fn (string $format) => app($format));
    }

    public static function getHlsPlaylists(): Collection
    {
        return collect(config('playlist.hls_playlists', []))
            ->map(fn (array $playlist) => fluent($playlist))
            ->sortBy('bit_rate');
    }

    public static function getExpiresAfter(): ?Carbon
    {
        $expires = config('playlist.expires_after');

        return $expires === null ? null : Carbon::now()->addSeconds($expires);
    }

    public static function copyVideoCodec(): bool
    {
        return config('playlist.copy_video_codec', true);
    }

    public static function copyAudioCodec(): bool
    {
        return config('playlist.copy_audio_codec', true);
    }

    public static function preventTranscoding(): bool
    {
        return config('playlist.prevent_transcoding', true);
    }
}
