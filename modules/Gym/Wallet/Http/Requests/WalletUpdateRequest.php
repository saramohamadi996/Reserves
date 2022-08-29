<?php

namespace Gym\Wallet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [

            "admin_id" => ['nullable', 'exists:users,id'],
            "user_id" => ['nullable', 'exists:users,id'],
            "card_id" => 'nullable|exists:cards,id',
            "amount" => 'nullable|numeric|min:0|max:1000000000',
            "description" => 'nullable|min:3|max:190',
            'date_payment'=> 'nullable|date|date_format:Y/m/d',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            "amount" => "مبلغ",
            "description" => "توضیحات",
            "card_id" => "کارت بانکی",
            "admin_id" => "نام ادمین",
            "user_id" => "نام کاربر",
            "date_payment" => "تاریخ",

        ];
    }
}
