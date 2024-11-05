<?php

declare(strict_types=1);

namespace App\Web\Shared\Concerns;

use Illuminate\Database\Eloquent\Model;

trait WithFormTranslations
{
    protected function setTranslations(): void
    {
        collect($this->all())
            ->filter(fn (mixed $value) => is_string($value) && filled($value))
            ->each(fn (?string $value, string $key) => data_set($this, $key, str($value ?: '')->squish()->value()));
    }

    protected function getModelTranslations(Model $model, ?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        return collect($model->getTranslations())
            ->map(fn (?array $item) => data_get($item, $locale, ''))
            ->toArray();
    }
}
