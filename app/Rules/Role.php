<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Role implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $allowedValues = ['admin', 'user', 'viewer'];

        if (!in_array($value, $allowedValues)) {
            $fail('The :attribute must be admin, user or viewer.');
        }
    }
}
