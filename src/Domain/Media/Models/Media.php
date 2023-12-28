<?php

namespace Domain\Media\Models;

use Domain\Media\Collections\MediaCollection;
use Domain\Media\QueryBuilders\MediaQueryBuilder;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use LogsActivity;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'collection_name',
        'disk',
        'conversions_disk',
        'size',
        'manipulations',
        'custom_properties',
        'generated_conversions',
        'responsive_images',
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
    protected $casts = [
        'manipulations' => 'json',
        'custom_properties' => 'json',
        'generated_conversions' => 'array',
        'responsive_images' => 'array',
    ];

    public function newEloquentBuilder($query): MediaQueryBuilder
    {
        return new MediaQueryBuilder($query);
    }

    public function newCollection(array $models = []): MediaCollection
    {
        return new MediaCollection($models);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
