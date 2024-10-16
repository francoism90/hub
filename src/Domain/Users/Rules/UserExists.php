<?php

declare(strict_types=1);

namespace Domain\Users\Rules;

use Closure;
use Domain\Users\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class UserExists implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! User::findByPrefixedId($value)->exists()) {
            $fail(__('The given user does not exists.'));
        }
    }
}
