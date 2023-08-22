<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Resources\ImportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImport extends EditRecord
{
    protected static string $resource = ImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
