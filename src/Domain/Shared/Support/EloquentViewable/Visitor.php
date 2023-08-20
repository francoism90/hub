<?php

namespace Domain\Shared\Support\EloquentViewable;

use CyrildeWit\EloquentViewable\Visitor as BaseVisitor;

class Visitor extends BaseVisitor
{
    public function id(): string
    {
        return $this->request()
            ?->user()
            ?->getKey();
    }
}
