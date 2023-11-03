<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\InteractsWithAuthentication;
use App\Filament\Resources\TagResource\Forms\GeneralForm;
use App\Filament\Resources\TagResource\Pages;
use Domain\Tags\Models\Tag;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;

class TagResource extends Resource
{
    use InteractsWithAuthentication;
    use Translatable;

    protected static ?string $model = Tag::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                ...GeneralForm::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}'),
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

    public static function canViewAny(): bool
    {
        return static::hasRole('super-admin');
    }
}
