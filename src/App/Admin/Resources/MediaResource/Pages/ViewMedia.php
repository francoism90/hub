<?php

namespace App\Admin\Resources\MediaResource\Pages;

use App\Admin\Resources\MediaResource;
use Domain\Media\Models\Media;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewMedia extends ViewRecord
{
    protected static string $resource = MediaResource::class;

    public function getTitle(): string|Htmlable
    {
        return static::getRecordTitle();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label(__('View Model'))
                ->visible(fn (Media $record) => $record->model instanceof Video)
                ->url(fn (Media $record) => route('filament.admin.resources.videos.edit', $record->model)),

            Actions\ViewAction::make()
                ->label(__('View Model'))
                ->visible(fn (Media $record) => $record->model instanceof Tag)
                ->url(fn (Media $record) => route('filament.admin.resources.tags.edit', $record->model)),
        ];
    }
}
