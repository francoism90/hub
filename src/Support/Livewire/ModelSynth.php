<?php

namespace Support\Livewire;

use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Features\SupportModels\ModelSynth as Synth;

class ModelSynth extends Synth
{
    public function dehydrate($target)
    {
        if (! $target->exists) {
            throw new \Exception('Can\'t set model as property if it hasn\'t been persisted yet');
        }

        // If no alias is found, this just returns the class name
        $alias = $target->getMorphClass();

        $serializedModel = (array) $this->getSerializedPropertyValue($target);

        return [
            null,
            ['class' => $alias, 'key' => $target->getRouteKey()],
        ];
    }

    public function hydrate($data, $meta)
    {
        $key = $meta['key'];
        $class = $meta['class'];

        // If no alias found, this returns `null`
        $aliasClass = Relation::getMorphedModel($class);

        if (! is_null($aliasClass)) {
            $class = $aliasClass;
        }

        // dd((new $class)->getRouteKeyName());

        $model = (new $class)
            ->newQueryWithoutScopes()
            ->where((new $class)->getRouteKeyName(), $key)
            ->useWritePdo()
            ->firstOrFail();

        return $model;
    }
}
