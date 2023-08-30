<?php

namespace App\Admin\Resources\UserResource\Pages;

use App\Admin\Concerns\InteractsWithAuthentication;
use App\Admin\Concerns\InteractsWithFormData;
use App\Admin\Resources\UserResource;
use Domain\Users\Actions\RegenerateUser;
use Domain\Users\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditUser extends EditRecord
{
    use InteractsWithAuthentication;
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
            // Custom actions
            Actions\Action::make('regenerate')
                ->label('Regenerate')
                ->visible(static::hasRole('super-admin'))
                ->action(fn (User $record) => app(RegenerateUser::class)->execute($record)),

            // Filament actions
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
