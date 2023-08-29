<?php

namespace App\Admin\Resources;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\TagResource\Pages;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;

class TagResource extends Resource
{
    use InteractsWithFormData;
    use Translatable;

    protected static ?string $model = Tag::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('type')
                    ->required()
                    ->options(TagType::toArray()),
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
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}'),
        ];
    }
}
