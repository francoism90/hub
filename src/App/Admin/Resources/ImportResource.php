<?php

namespace App\Admin\Resources;

use App\Admin\Concerns\InteractsWithAuthentication;
use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\ImportResource\Pages;
use Domain\Imports\Models\Import;
use Filament\Resources\Resource;

class ImportResource extends Resource
{
    use InteractsWithAuthentication;
    use InteractsWithFormData;

    protected static ?string $model = Import::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-cloud-arrow-up';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImports::route('/'),
            'edit' => Pages\EditImport::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
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

    public static function getNavigationLabel(): string
    {
        return __('Import');
    }
}
