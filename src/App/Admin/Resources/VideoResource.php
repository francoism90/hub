<?php

namespace App\Admin\Resources;

use App\Admin\Concerns\InteractsWithAuthentication;
use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\VideoResource\Pages;
use App\Admin\Resources\VideoResource\RelationManagers;
use Domain\Videos\Models\Video;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoResource extends Resource
{
    use InteractsWithAuthentication;
    use InteractsWithFormData;
    use Translatable;

    protected static ?string $model = Video::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-play';

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Manage');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}'),
        ];
    }

    public static function canViewAny(): bool
    {
        return static::hasRole('super-admin');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
