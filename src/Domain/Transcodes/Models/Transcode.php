<?php

declare(strict_types=1);

namespace Domain\Transcodes\Models;

use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Users\Concerns\InteractsWithUser;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Support\FFMpeg\Format\Video\X264;

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
        'metadata',
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
            'metadata' => AsArrayObject::class,
            'expires_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getDisk(): FilesystemAdapter
    {
        return Storage::disk($this->disk);
    }

    public function getPath(): string
    {
        return (string) $this->getKey();
    }

    public function getAbsolutePath(): string
    {
        return $this->getDisk()->path($this->getPath());
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
