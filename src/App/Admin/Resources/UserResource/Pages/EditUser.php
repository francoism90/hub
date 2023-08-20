<?php

namespace App\Admin\Resources\UserResource\Pages;

use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditUser extends EditRecord
{
    use InteractsWithFormData;

    protected static string $resource = UserResource::class;

    public function getTitle(): string|Htmlable
    {
        if ($this->getRecord()->is(auth()->user())) {
            return __('Profile');
        }

        return parent::getRecordTitle();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
