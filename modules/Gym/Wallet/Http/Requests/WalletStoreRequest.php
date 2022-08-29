<?php

namespace Gym\Wallet\Http\Requests;

use Gym\Service\Rules\ValidUser;
use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            "user_id" => ['required', 'exists:users,id'],
            "card_id" => 'required|exists:cards,id',
            "amount" => 'required|numeric|min:0|max:1000000000',
            "description" => 'nullable|min:3|max:190',
            'date_payment'=> 'nullable',
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
