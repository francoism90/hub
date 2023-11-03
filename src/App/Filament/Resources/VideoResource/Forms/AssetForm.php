<?php

namespace App\Filament\Resources\VideoResource\Forms;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

abstract class AssetForm
{
    public static function clips(): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make('clips')
            ->label(__('Clips'))
            ->multiple()
            ->collection('clips')
            ->disk('media')
            ->conversionsDisk('conversions')
            ->downloadable()
            ->acceptedFileTypes([
                'video/av1',
                'video/mp4',
                'video/mp4v-es',
                'video/ogg',
                'video/quicktime',
                'video/webm',
                'video/x-m4v',
                'video/x-matroska',
            ]);
    }

    public static function captions(): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make('captions')
            ->label(__('Captions'))
            ->multiple()
            ->collection('captions')
            ->disk('conversions')
            ->conversionsDisk('conversions')
            ->downloadable()
            ->acceptedFileTypes([
                'text/plain',
                'text/vtt',
            ]);
    }

    public static function thumbnail(): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make('thumbnail')
            ->label(__('Thumbnail'))
            ->collection('thumbnail')
            ->disk('conversions')
            ->conversionsDisk('conversions')
            ->responsiveImages()
            ->downloadable()
            ->acceptedFileTypes([
                'image/avif',
                'image/jpg',
                'image/jpeg',
                'image/png',
                'image/webp',
            ]);
    }

    public static function previews(): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make('previews')
            ->label(__('Preview'))
            ->collection('previews')
            ->disk('conversions')
            ->conversionsDisk('conversions')
            ->downloadable()
            ->acceptedFileTypes([
                'video/av1',
                'video/mp4',
                'video/mp4v-es',
                'video/ogg',
                'video/quicktime',
                'video/webm',
                'video/x-m4v',
                'video/x-matroska',
            ]);
    }

    public static function make(): array
    {
        return [
            static::clips(),
            static::captions(),
            static::thumbnail(),
            static::previews(),
        ];
    }
}
