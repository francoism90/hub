<?php

namespace App\Admin\Resources\MediaResource\Forms;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    public static function model(): MorphToSelect
    {
        return MorphToSelect::make('model')
            ->label(__('Parent'))
            ->searchable()
            ->types([
                MorphToSelect\Type::make(Video::class)
                    ->titleAttribute('name'),

                MorphToSelect\Type::make(Tag::class)
                    ->titleAttribute('name'),
            ]);
    }

    public static function name(): TextInput
    {
        return TextInput::make('file_name')
            ->label(__('Filename'))
            ->required()
            ->disabled();
    }

    public static function make(): array
    {
        return [
            static::model(),
            static::name(),
        ];
    }
}
