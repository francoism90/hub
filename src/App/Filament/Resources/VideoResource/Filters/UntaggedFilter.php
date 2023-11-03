<?php

namespace App\Filament\Resources\VideoResource\Filters;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UntaggedFilter extends Filter
{
    public static function getDefaultName(): ?string
    {
        return 'untagged';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->toggle();

        $this->label(__('Untagged'));

        $this->query(fn (Builder $query): Builder => $query->whereDoesntHave('tags'));
    }
}
