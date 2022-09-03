<?php

namespace Gym\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequestStore extends FormRequest
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
            'title' => 'required|string|min:3|max:190|unique:categories,title',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'parent_id' => 'دسته بندی اصلی',
        ];
    }
}
