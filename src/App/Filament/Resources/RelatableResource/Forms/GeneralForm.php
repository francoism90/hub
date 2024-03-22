<?php

namespace App\Filament\Resources\RelatableResource\Forms;

use Domain\Tags\Models\Tag;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    public static function make(): array
    {
        return [
            static::relate(),
            static::score(),
            static::boost(),
        ];
    }

    public static function relate(): MorphToSelect
    {
        return MorphToSelect::make('relate')
            ->label(__('Relates To'))
            ->required()
            ->types([
                MorphToSelect\Type::make(Tag::class)
                    ->titleAttribute('name'),
            ]);
    }

    public static function score(): TextInput
    {
        return TextInput::make('score')
            ->label(__('Score'))
            ->numeric()
            ->nullable()
            ->step(0.1)
            ->maxLength(10);
    }

    public static function boost(): TextInput
    {
        return TextInput::make('boost')
            ->label(__('Boost'))
            ->numeric()
            ->nullable()
            ->step(0.1)
            ->maxLength(10);
    }
}
