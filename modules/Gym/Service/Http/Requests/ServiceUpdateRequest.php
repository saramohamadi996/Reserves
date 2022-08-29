<?php

namespace Gym\Service\Http\Requests;

use Gym\Service\Rules\ValidUser;
use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|string|min:3|max:190|unique:services,title' . request()->route('services'),
            "slug" => 'nullable|string|min:3|max:190',
            'code_service' => 'required|string|min:3|max:190|unique:services,code_service' . request()->route('services'),
            "priority" => 'nullable|unique:services,priority|numeric|min:0',
            "category_id" => 'required|exists:categories,id',
            "price_group_id" => 'required|exists:price_groups,id',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            "title" => "عنوان",
            "slug" => "عنوان انگلیسی",
            "priority" => "ردیف خدمت",
            "price_group_id" => "قیمت",
            "code_service" => "کد خدمت",
            "category_id" => "دسته بندی",
        ];
    }
}
