<?php

declare(strict_types=1);

namespace Domain\Tags\Rules;

use Closure;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Validation\ValidationRule;

class TagExists implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Tag::findByPrefixedId($value)->exists()) {
            $fail(__('The given tag does not exists.'));
        }
    }
}
