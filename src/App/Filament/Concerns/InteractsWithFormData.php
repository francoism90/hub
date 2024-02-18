<?php

namespace App\Filament\Concerns;

use Spatie\PrefixedIds\PrefixedIds;

trait InteractsWithFormData
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $this->prepareFormDataBeforeFill($data);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->prepareFormDataBeforeSave($data);
    }

    protected function prepareFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();

        unset($data['prefixed_id']);

        if (array_key_exists('id', $data)) {
            $data['id'] = $record->getRouteKey();
        }

        return $data;
    }

    protected function prepareFormDataBeforeSave(array $data): array
    {
        if (array_key_exists('id', $data) && PrefixedIds::getModelClass($data['id'])) {
            $data['id'] = PrefixedIds::findOrFail($data['id'])->getKey();
        }

        return $data;
    }
}
