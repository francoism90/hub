<?php

namespace App\Admin\Resources\PlaylistResource\Forms;

use App\Admin\Concerns\InteractsWithAuthentication;
use App\Admin\Concerns\InteractsWithState;
use Domain\Playlists\States\PlaylistState;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    use InteractsWithAuthentication;
    use InteractsWithState;

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->required()
            ->maxLength(255);
    }

    public static function type(): Select
    {
        return Select::make('type')
            ->nullable()
            ->visible(fn () => static::hasRole('super-admin'))
            ->options(fn () => static::stateOptions(PlaylistState::class));
    }

    public static function make(): array
    {
        return [
            static::name(),
            static::type(),
        ];
    }
}
