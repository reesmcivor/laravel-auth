<?php

namespace ReesMcIvor\Auth\HttpRequests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            'link' => 'sometimes'
        ];
    }
}
