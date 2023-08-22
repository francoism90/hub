<?php

namespace App\Admin\Resources\ImportResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\ImportResource;
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
