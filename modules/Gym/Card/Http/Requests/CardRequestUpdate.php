<?php

namespace Gym\Card\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name_account_holder' => 'required|string|min:3|max:100',
            "bank_name" => 'required|min:3|max:190|string',
            "card_number" => 'required|size:16|string|unique:cards,bank_name' . request()->route('cards'),
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name_account_holder' => 'نام صاحب حساب',
            'bank' => 'نام بانک',
            'card_number' => 'شماره کارت بانکی',
        ];
    }
}
