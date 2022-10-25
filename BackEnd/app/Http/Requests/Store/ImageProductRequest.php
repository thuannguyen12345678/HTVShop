<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class ImageProductRequest extends FormRequest
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
            'image' => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'product_id.required' => 'Trường bắt buộc',
            'image.required' => 'Trường bắt buộc',
        ];
    }
}
