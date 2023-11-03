<?php

namespace App\Filament\Widgets;

use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Users'), User::count()),
            Stat::make(__('Videos'), Video::count()),
            Stat::make(__('Tags'), Tag::count()),
        ];
    }
}
