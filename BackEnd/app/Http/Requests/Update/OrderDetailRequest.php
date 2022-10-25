<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
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
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_total_price' => 'required',
            'product_id' => 'required',
            'order_id' => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc',
            'category_id.required' => 'Trường bắt buộc',
            'amount.required' => 'Trường bắt buộc',
            'price.required' => 'Trường bắt buộc',
            'description.required' => 'Trường bắt buộc',
            'brand_id.required' => 'Trường bắt buộc',
        ];
    }
}
