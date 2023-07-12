<?php

namespace ReesMcIvor\Auth\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use ReesMcIvor\Auth\Rules\OldPasswordCheckRule;

class NewPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user();
    }

    public function rules()
    {
        return [
            'old_password' => ['required', new OldPasswordCheckRule()],
            'password' => 'required',
        ];
    }
}
