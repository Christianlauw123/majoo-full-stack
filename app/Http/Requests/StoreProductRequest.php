<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image_path' => 'required|image',
            'product_category_id' => 'required|exists:product_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama perlu diisi',
            'name.max' => 'Nama maksimal :max karakter',
            'name.unique' => 'Nama telah digunakan',

            'description.required' => 'Deskripsi perlu diisi',

            'image_path.required' => 'Gambar belum dipilih',
            'image_path.image' => 'Format gambar tidak valid',

            'price.required' => 'Harga perlu diisi',
            'price.numeric' => 'Harga harus angka',
            'price.min' => 'Harga minimal :min',

            'product_category_id.required' => 'Product Category perlu dipilih',
            'product_category_id.exists' => 'Product Category tidak ditemukan, harap muat ulang',
        ];
    }
}
