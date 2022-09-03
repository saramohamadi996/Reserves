<?php

namespace Gym\User\Http\Requests;

use Gym\User\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'mobile' => 'required|string|min:9|max:14|unique:users', new ValidMobile(),
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
