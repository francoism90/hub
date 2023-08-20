<?php

namespace Domain\Shared\Concerns;

use CyrildeWit\EloquentViewable\InteractsWithViews as BaseInteractsWithViews;
use Domain\Shared\Support\EloquentViewable\Visitor;
use Illuminate\Database\Eloquent\Model;

trait InteractsWithViews
{
    use BaseInteractsWithViews;

    /**
     * @var bool
     */
    protected $removeViewsOnDelete = true;

    public function view(): void
    {
        views($this)
            ->useVisitor(app(Visitor::class))
            ->cooldown(15)
            ->record();
    }

    public function isViewedBy(Model $viewer): bool
    {
        return $this
            ->views()
            ->where('visitor', $viewer->getKey())
            ->exists();
    }
}
