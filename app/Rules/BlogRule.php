<?php

namespace App\Rules;

use App\Models\Blog;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BlogRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( Blog::where('id', $value)->first() === null ) {
            $fail("Blog With id ". $value ." Not found");
        }
    }
}
