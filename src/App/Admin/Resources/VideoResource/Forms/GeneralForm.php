<?php

namespace App\Admin\Resources\VideoResource\Forms;

use App\Admin\Concerns\InteractsWithPlaylists;
use App\Admin\Concerns\InteractsWithState;
use App\Admin\Concerns\InteractsWithTags;
use Domain\Videos\Models\Video;
use Domain\Videos\States\VideoState;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    use InteractsWithPlaylists;
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
            ->suffixAction(
                Action::make('title_case')
                    ->icon('heroicon-o-language')
                    ->action(function (TextInput $component, mixed $state) {
                        $component->state(
                            str($state)
                                ->replace(['.', '_'], ' ')
                                ->title()
                                ->trim()
                                ->value()
                        );
                    })
            );
    }

    public static function season(): TextInput
    {
        return TextInput::make('season')
            ->label(__('Season'))
            ->nullable()
            ->string()
            ->maxLength(255);
    }

    public static function episode(): TextInput
    {
        return TextInput::make('episode')
            ->label(__('Episode'))
            ->nullable()
            ->string()
            ->maxLength(255);
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
            ->suffixAction(
                Action::make('current_time')
                    ->icon('heroicon-o-camera')
                    ->action(function (TextInput $component, Video $record, mixed $state) {
                        $videoable = static::getHistory()
                            ->videos()
                            ->firstWhere('id', $record->getKey());

                        $component->state(
                            $videoable?->pivot?->options['timestamp'] ?: $state
                        );
                    })
            );
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
            ->columns(3)
            ->label(__('Id'))
            ->schema([
                static::season(),
                static::episode(),
                static::released(),
            ]);
    }

    public static function status(): Grid
    {
        return Grid::make('status')
            ->columns(2)
            ->label(__('Status'))
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
            static::status(),
        ];
    }
}
