<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand_id' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc',
            'category_id.required' => 'Trường bắt buộc',
            'amount.required' => 'Trường bắt buộc',
            'amount.numeric' => 'Bắt buộc nhập số',
            'price.required' => 'Trường bắt buộc',
            'price.numeric' => 'Bắt buộc nhập số',
            'description.required' => 'Trường bắt buộc',
            'brand_id.required' => 'Trường bắt buộc',
        ];
    }
}
