<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\InteractsWithAuthentication;
use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use Domain\Videos\Models\Video;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class VideoResource extends Resource
{
    use InteractsWithAuthentication;
    use Translatable;

    protected static ?string $model = Video::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-play';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }

    public static function canViewAny(): bool
    {
        return static::hasRole('super-admin');
    }

    public static function getNavigationGroup(): string
    {
        return __('Manage');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'season',
            'episode',
            'part',
            'released_at',
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('media', 'tags');
    }
}
