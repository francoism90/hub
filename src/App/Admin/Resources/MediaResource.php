<?php

namespace App\Admin\Resources;

use App\Admin\Resources\MediaResource\Pages;
use Domain\Media\Models\Media;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Manage');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}'),
        ];
    }
}
