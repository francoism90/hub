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
        $types = is_array($value) ? implode(' ', $value) : $value;

        $types = str($value)->matchAll('/filter:(\w*)/');

        $types->each(fn (string $str) => ! FilterType::tryFrom($str)
            ? $fail(__('The given filter does not exists.'))
            : null
        );
    }
}
