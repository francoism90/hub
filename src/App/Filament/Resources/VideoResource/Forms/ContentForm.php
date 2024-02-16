<?php

namespace App\Filament\Resources\VideoResource\Forms;

use Filament\Forms\Components\MarkdownEditor;

abstract class ContentForm
{
    public static function make(): array
    {
        return [
            static::summary(),
            static::content(),
        ];
    }

    public static function summary(): MarkdownEditor
    {
        return MarkdownEditor::make('summary')
            ->label(__('Summary'))
            ->nullable()
            ->string()
            ->maxLength(2048);
    }

    public static function content(): MarkdownEditor
    {
        return MarkdownEditor::make('content')
            ->label(__('Content'))
            ->nullable()
            ->string()
            ->maxLength(4096);
    }
}
