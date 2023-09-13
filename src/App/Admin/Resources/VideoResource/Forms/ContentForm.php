<?php

namespace App\Admin\Resources\VideoResource\Forms;

use Filament\Forms\Components\MarkdownEditor;

abstract class ContentForm
{
    public static function summary(): MarkdownEditor
    {
        return MarkdownEditor::make('summary')
            ->label(__('Summary'))
            ->nullable()
            ->string();
    }

    public static function content(): MarkdownEditor
    {
        return MarkdownEditor::make('content')
            ->label(__('Content'))
            ->nullable()
            ->string();
    }

    public static function make(): array
    {
        return [
            static::summary(),
            static::content(),
        ];
    }
}
