<?php

namespace Domain\Users\Actions;

use Domain\Shared\Concerns\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;

class MarkModelAsViewed
{
    public function execute(Model $model): void
    {
        throw_if(! in_array(InteractsWithViews::class, class_uses_recursive($model)));

        $model->view();
    }
}
