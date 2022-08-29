<?php

namespace Gym\Service\Http\Requests;

use Gym\Service\Rules\ValidUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [

            "admin_id" => ['required', 'exists:users,id'],
            "user_id" => ['required', 'exists:users,id'],
            "card_id" => 'required|exists:cards,id',
            "amount" => 'required|numeric|min:0|max:1000000000',
            "description" => 'nullable|min:3|max:190',
            'date_payment'=> 'required|date|date_format:Y/m/d',
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
