<?php

namespace Gym\Sens\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules()
    {

        $rules = [
            "user_id" => ['nullable', 'exists:users,id'],
            "service_id" => 'nullable|exists:services,id',
            "volume" => 'required|numeric',
            "day" => 'array',
            'start'=> 'required',
            'end'=> 'required',
            'start_at' => 'nullable|date|date_format:Y/m/d|before:expire_at',
            'expire_at'=> 'nullable|date|date_format:Y/m/d|after:start_at',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            "user_id" => "کاربر",
            "service_id" => "شناسه خدمت",
            "volume" => 'ظرفیت',
            "start" => "شروع",
            "end" => "پایان",
            "start_at" => "تاریخ شروع",
            "expire_at" => "تاریخ انقضاء",
        ];
    }
}
