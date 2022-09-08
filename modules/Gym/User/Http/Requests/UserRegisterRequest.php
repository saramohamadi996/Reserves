<?php

namespace Gym\User\Http\Requests;

use Gym\User\Models\User;
use Gym\User\Rules\ValidMobile;
use Gym\User\Rules\ValidPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
//            'username' => 'required|string|max:255|unique:users',
            'mobile' => 'required|string|min:9|max:14|unique:users', new ValidMobile(),
            'password'=>'required|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            "name" => "نام",
            "username" => "نام کاربری",
            "mobile" => "موبایل",
        ];
    }
}
