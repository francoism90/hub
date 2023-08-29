<?php

namespace App\Admin\Resources\PlaylistResource\Pages;

use App\Admin\Resources\PlaylistResource;
use App\Admin\Resources\PlaylistResource\Forms\GeneralForm;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreatePlaylist extends CreateRecord
{
    protected static string $resource = PlaylistResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                GeneralForm::name(),
            ]);
    }
}
