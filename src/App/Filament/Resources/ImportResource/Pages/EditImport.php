<?php

namespace App\Filament\Resources\ImportResource\Pages;

use App\Filament\Concerns\InteractsWithFormData;
use App\Filament\Resources\ImportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImport extends EditRecord
{
    use InteractsWithFormData;

    protected static string $resource = ImportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
