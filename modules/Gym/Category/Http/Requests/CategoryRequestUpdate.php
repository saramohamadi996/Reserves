<?php

namespace Gym\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequestUpdate extends FormRequest
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
            'title' => 'required|string|min:3|max:190' . request()->route('categories'),
            'slug' => 'nullable|string|min:3|max:190',
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
            'slug' => 'نامک',
            'parent_id' => 'دسته بندی اصلی',
        ];
    }
}
