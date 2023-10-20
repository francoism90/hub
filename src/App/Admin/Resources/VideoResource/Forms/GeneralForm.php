<?php

namespace App\Admin\Resources\VideoResource\Forms;

use App\Admin\Actions\TitleCaseAction;
use App\Admin\Concerns\InteractsWithState;
use App\Admin\Concerns\InteractsWithTags;
use App\Admin\Resources\VideoResource\Actions\CurrentTimeAction;
use Domain\Videos\States\VideoState;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;

abstract class GeneralForm
{
    use InteractsWithState;
    use InteractsWithTags;

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Name'))
            ->required()
            ->string()
            ->autofocus()
            ->maxLength(255)
            ->afterStateUpdated(fn (Set $set, mixed $state) => $set('name', trim($state)))
            ->suffixAction(TitleCaseAction::make());
    }

    public static function season(): TextInput
    {
        return TextInput::make('season')
            ->label(__('Season'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->afterStateUpdated(fn (Set $set, mixed $state) => $set('season', trim($state)))
            ->suffixAction(TitleCaseAction::make());
    }

    public static function episode(): TextInput
    {
        return TextInput::make('episode')
            ->label(__('Episode'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->afterStateUpdated(fn (Set $set, mixed $state) => $set('episode', trim($state)))
            ->suffixAction(TitleCaseAction::make());
    }

    public static function part(): TextInput
    {
        return TextInput::make('part')
            ->label(__('Part / Scene'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->afterStateUpdated(fn (Set $set, mixed $state) => $set('part', trim($state)))
            ->suffixAction(TitleCaseAction::make());
    }

    public static function released(): DatePicker
    {
        return DatePicker::make('released_at')
            ->label(__('Released At'))
            ->nullable()
            ->seconds(false)
            ->placeholder('YYYY-MM-DD')
            ->displayFormat('Y-m-d')
            ->format('Y-m-d');
    }

    public static function snapshot(): TextInput
    {
        return TextInput::make('snapshot')
            ->label(__('Snapshot'))
            ->nullable()
            ->numeric()
            ->suffixAction(CurrentTimeAction::make());
    }

    public static function state(): Select
    {
        return Select::make('state')
            ->required()
            ->options(static::stateOptions(VideoState::class));
    }

    public static function id(): Grid
    {
        return Grid::make('id')
            ->columns(4)
            ->label(__('Id'))
            ->schema([
                static::season(),
                static::episode(),
                static::part(),
                static::released(),
            ]);
    }

    public static function meta(): Grid
    {
        return Grid::make('meta')
            ->columns(2)
            ->label(__('Metadata'))
            ->schema([
                static::state(),
                static::snapshot(),
            ]);
    }

    public static function make(): array
    {
        return [
            static::name(),
            static::tags(),
            static::id(),
            static::meta(),
        ];
    }
}
