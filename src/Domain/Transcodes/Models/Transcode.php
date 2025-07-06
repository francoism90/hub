<?php

declare(strict_types=1);

namespace Domain\Transcodes\Models;

use Domain\Transcodes\Collections\TranscodeCollection;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Transcodes\Observers\TranscodeObserver;
use Domain\Transcodes\QueryBuilders\TranscodeQueryBuilder;
use Domain\Transcodes\Scopes\OrderedScope;
use Domain\Users\Concerns\InteractsWithUser;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Filesystem\FilesystemAdapter;
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
        'model_type',
        'model_id',
        'pipeline',
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
            'pipeline' => PipelineData::class,
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
        return $this->pipeline->destination ?? config('transcode.disk_name');
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

    public function isFinished(): bool
    {
        return $this->finished_at !== null && $this->finished_at->isPast();
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function isActive(): bool
    {
        return $this->isFinished() && ! $this->isExpired();
    }

    public static function copyVideoCodec(): array
    {
        return config('transcode.copy_video_codecs', []);
    }

    public static function copyAudioCodec(): array
    {
        return config('transcode.copy_audio_codecs', []);
    }
}
