<?php

namespace Domain\Videos\Rules;

use Closure;
use Domain\Videos\Enums\FilterType;
use Illuminate\Contracts\Validation\ValidationRule;

class FilterExists implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str($value)->replaceFirst('filter:', '');

        if (! FilterType::tryFrom($value)) {
            $fail(__('The given filter does not exists.'));
        }
    }
}
