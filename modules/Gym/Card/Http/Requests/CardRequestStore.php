<?php

namespace Gym\Card\Http\Requests;

use Gym\Service\Rules\ValidUser;
use Illuminate\Foundation\Http\FormRequest;

class CardRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_account_holder' => 'required|string|min:3|max:100',
            "bank_name" => 'required|min:3|max:190|string',
            "card_number" => 'required|unique:cards,card_number|size:16|string',
            ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name_account_holder' => 'نام صاحب حساب',
            'bank_name' => 'نام بانک',
            'card_number' => 'شماره کارت بانکی',
        ];
    }
}
