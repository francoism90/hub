<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Concerns\InteractsWithFormData;
use App\Filament\Resources\MediaResource;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditMedia extends EditRecord
{
    use InteractsWithFormData;

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
                ->color('gray')
                ->visible(fn (Model $record) => $record->model instanceof Video)
                ->url(fn (Model $record) => route('filament.admin.resources.videos.edit', $record->model)),

            Actions\ViewAction::make()
                ->label(__('View Model'))
                ->color('gray')
                ->visible(fn (Model $record) => $record->model instanceof Tag)
                ->url(fn (Model $record) => route('filament.admin.resources.tags.edit', $record->model)),

            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }
}
