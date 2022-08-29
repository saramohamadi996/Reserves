<?php
namespace Gym\User\Http\Requests;

use Gym\User\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            "name" => 'nullable|min:3|max:190',
            "username" => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user'),
            "email" => 'nullable|email|min:3|max:190|unique:users,email,' . request()->route('user'),
            "mobile" => 'nullable|unique:users,mobile,' . request()->route('user'),
            "status" => ["nullable", Rule::in(User::$statuses)],
        ];
    }

    public function attributes()
    {
        return [
            "name" => "نام",
            "email" => "ایمیل",
            "username" => "نام کاربری",
            "mobile" => "موبایل",
            "status" => "وضعیت",
        ];
    }
}
