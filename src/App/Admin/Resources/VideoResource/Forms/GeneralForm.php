<?php

namespace App\Admin\Resources\VideoResource\Forms;

use App\Admin\Concerns\InteractsWithTags;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

abstract class GeneralForm
{
    use InteractsWithTags;

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Name'))
            ->required();
    }



    public static function make(): array
    {
        return [
            static::name(),
            static::tags(),
        ];
    }
}
