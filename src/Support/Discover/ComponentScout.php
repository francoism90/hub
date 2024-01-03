<?php

namespace Support\Discover;

use Illuminate\View\Component;
use Spatie\StructureDiscoverer\Discover;
use Spatie\StructureDiscoverer\StructureScout;

class ComponentScout extends StructureScout
{
    protected function definition(): Discover
    {
        return Discover::in(app_path('Web'))
            ->extending(Component::class)
            ->full();
    }
}
