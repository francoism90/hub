<?php

namespace App\Admin\Resources;

use App\Admin\Concerns\InteractsWithAuthentication;
use App\Admin\Concerns\InteractsWithScout;
use App\Admin\Resources\UserResource\Pages;
use Domain\Users\Models\User;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    use InteractsWithAuthentication;
    use InteractsWithScout;

    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\Tabs::make('user-details')->tabs([
                    Components\Tabs\Tab::make('General Details')->schema([
                        Components\TextInput::make('name')
                            ->required()
                            ->maxLength(40),

                        Components\TextInput::make('email')
                            ->required()
                            ->email(),
                    ]),

                    Components\Tabs\Tab::make('Security')->schema([
                        Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create'),
                    ]),
                ]),

                // ...
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}'),
        ];
    }

    public static function canViewAny(): bool
    {
        return static::hasRole('super-admin');
    }

    public static function getNavigationGroup(): string
    {
        return __('Manage');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
