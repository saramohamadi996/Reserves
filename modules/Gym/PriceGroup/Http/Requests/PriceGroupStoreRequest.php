<?php

namespace Gym\PriceGroup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceGroupStoreRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:190|unique:price_groups,title',
            "price" => 'required|min:0|max:1000000000',
            "category_id" => 'required|exists:categories,id',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'price' => 'قیمت',
            'category_id' => 'دسته بندی',
        ];
    }
}
