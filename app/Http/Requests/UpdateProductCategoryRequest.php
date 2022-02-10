<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role == "Admin";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'name' => 'required|max:255|unique:product_categories,name,'.$this->product_category,
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama perlu diisi',
            'name.max' => 'Nama maksimal :max karakter',
            'name.unique' => 'Nama telah digunakan',
        ];
    }
}
