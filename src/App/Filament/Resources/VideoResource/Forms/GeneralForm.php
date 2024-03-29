<?php

namespace App\Filament\Resources\VideoResource\Forms;

use App\Filament\Actions\HeadlineCaseAction;
use App\Filament\Actions\IdentifierCaseAction;
use App\Filament\Actions\TitleCaseAction;
use App\Filament\Concerns\InteractsWithState;
use App\Filament\Forms\Components\TagInput;
use App\Filament\Resources\VideoResource\Actions\CurrentTimeAction;
use Domain\Tags\Models\Tag;
use Domain\Videos\States\VideoState;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

abstract class GeneralForm
{
    use InteractsWithState;

    public static function make(): array
    {
        return [
            static::name(),
            static::tags(),
            static::id(),
            static::meta(),
        ];
    }

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Name'))
            ->required()
            ->string()
            ->autofocus()
            ->maxLength(255)
            ->suffixActions([
                HeadlineCaseAction::make(),
                TitleCaseAction::make(),
            ]);
    }

    public static function tags(): Select
    {
        return TagInput::make('tags')
            ->options(Tag::query()
                ->withCount('videos')
                ->orderByDesc('videos_count')
                ->take(10)
                ->pluck('name', 'id')
                ->toArray()
            );
    }

    public static function season(): TextInput
    {
        return TextInput::make('season')
            ->label(__('Season'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->suffixAction(IdentifierCaseAction::make());
    }

    public static function episode(): TextInput
    {
        return TextInput::make('episode')
            ->label(__('Episode'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->suffixAction(IdentifierCaseAction::make());
    }

    public static function part(): TextInput
    {
        return TextInput::make('part')
            ->label(__('Part / Scene'))
            ->nullable()
            ->string()
            ->maxLength(255)
            ->suffixAction(IdentifierCaseAction::make());
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
}
