<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageProductRequest extends FormRequest
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
            'product_id' => 'required',
            'file_name' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'product_id.required' => 'Trường bắt buộc',
            'file_name.required' => 'Trường bắt buộc',
        ];
    }
}
