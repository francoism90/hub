<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\InteractsWithAuthentication;
use App\Filament\Resources\MediaResource\Forms\GeneralForm;
use App\Filament\Resources\MediaResource\Forms\MetaForm;
use App\Filament\Resources\MediaResource\Pages;
use Domain\Media\Models\Media;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class MediaResource extends Resource
{
    use InteractsWithAuthentication;

    protected static ?string $model = Media::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                ...GeneralForm::make(),
                ...MetaForm::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}'),
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
}
