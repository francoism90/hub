<?php

namespace App\Admin\Resources;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\PlaylistResource\Pages;
use App\Admin\Resources\PlaylistResource\RelationManagers;
use Domain\Playlists\Models\Playlist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaylistResource extends Resource
{
    use InteractsWithFormData;
    use InteractsWithScout;
    use Translatable;

    protected static ?string $model = Playlist::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function getRelations(): array
    {
        return [
            RelationManagers\VideosRelationManager::class,
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Manage');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaylists::route('/'),
            'create' => Pages\CreatePlaylist::route('/create'),
            'edit' => Pages\EditPlaylist::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
