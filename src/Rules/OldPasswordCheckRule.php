<?php

namespace ReesMcIvor\Auth\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class OldPasswordCheckRule implements Rule
{
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'The old password is incorrect.';
    }
}
