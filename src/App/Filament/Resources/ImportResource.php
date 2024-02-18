<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\InteractsWithAuthentication;
use App\Filament\Resources\ImportResource\Pages;
use Domain\Imports\Models\Import;
use Filament\Resources\Resource;

class ImportResource extends Resource
{
    use InteractsWithAuthentication;

    protected static ?string $model = Import::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-cloud-arrow-up';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImports::route('/'),
            'edit' => Pages\EditImport::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('Manage');
    }

    public static function getNavigationLabel(): string
    {
        return __('Import');
    }

    public static function canAccess(): bool
    {
        return static::isAdmin();
    }
}
