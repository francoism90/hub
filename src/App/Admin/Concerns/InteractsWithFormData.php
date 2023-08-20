<?php

namespace App\Admin\Concerns;

use Spatie\Enum\Laravel\Enum;
use Spatie\ModelStates\State;

trait InteractsWithFormData
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $this->prepareFormDataBeforeFill($data);
    }

    protected function prepareFormDataBeforeFill(array $data): array
    {
        $data = collect($data)
            ->reject(fn (mixed $value, string $key) => in_array($key, ['prefixed_id']))
            ->map(function (mixed $value, string $key) {
                if ($key === 'id') {
                    return $this->getRecord()?->getRouteKey() ?? $value;
                }

                if ($key === 'user_id') {
                    return $this->getRecord()->user?->getRouteKey() ?? $value;
                }

                if ($value instanceof State) {
                    return class_basename($value);
                }

                if ($value instanceof Enum) {
                    return (string) $value;
                }

                return $value;
            });

        return $data->toArray();
    }
}
