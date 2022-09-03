<?php

namespace Gym\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            "title" => 'required|min:3|max:190',
            "category_id" => 'required|exists:categories,id',
            "code_service" => 'nullable|min:3|max:190',
            "priority" => 'nullable|numeric|min:0',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            "title" => "عنوان",
            "category_id" => "دسته بندی",
            "code_service" => 'کد خدمت',
            "priority" => 'ترتیب نمایش',
        ];
    }
}
