<?php

namespace Domain\Videos\Rules;

use Closure;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Validation\ValidationRule;

class VideoExists implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Video::findByPrefixedId($value)?->exists()) {
            $fail(__('The given video does not exists.'));
        }
    }
}
