<?php

namespace App\Filament\Resources\TagResource\Forms;

use App\Filament\Actions\TitleCaseAction;
use Domain\Tags\Enums\TagType;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    public static function make(): array
    {
        return [
            static::name(),
            static::types(),
            static::description(),
        ];
    }

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Name'))
            ->required()
            ->string()
            ->autofocus()
            ->maxLength(255)
            ->suffixAction(TitleCaseAction::make());
    }

    public static function description(): MarkdownEditor
    {
        return MarkdownEditor::make('description')
            ->label(__('Description'))
            ->nullable()
            ->maxLength(2048);
    }

    public static function types(): Select
    {
        return Select::make('type')
            ->label(__('Type'))
            ->required()
            ->options(fn () => collect(TagType::cases())->mapWithKeys(fn (TagType $item) => [
                $item->value => $item->label(),
            ]));
    }
}
