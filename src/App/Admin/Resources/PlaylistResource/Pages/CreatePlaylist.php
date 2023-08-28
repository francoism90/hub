<?php

namespace App\Admin\Resources\PlaylistResource\Pages;

use App\Admin\Resources\PlaylistResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components;

class CreatePlaylist extends CreateRecord
{
    protected static string $resource = PlaylistResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
