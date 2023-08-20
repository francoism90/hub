<?php

namespace App\Admin\Resources\TagResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;

class EditTag extends EditRecord
{
    use InteractsWithFormData;
    use Translatable;

    protected static string $resource = TagResource::class;

    public function getTitle(): string|Htmlable
    {
        return static::getRecordTitle();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
