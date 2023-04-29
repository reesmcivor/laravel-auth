<?php

namespace ReesMcIvor\Auth\Http\Requests\Api;

use App\Models\User;
use Illuminate\Support\Facades\Request;

class VerifyEmailRequest extends Request
{
    public function authorize()
    {
        return true;
        $user = User::query()->findOrFail($this->route('id'));

        if (! hash_equals((string) $this->route('hash'), sha1($user->getEmailForVerification()))) {
            return false;
        }

        $this->setUserResolver(function () use ($user) {
            return $user;
        });

        return true;
    }

}
