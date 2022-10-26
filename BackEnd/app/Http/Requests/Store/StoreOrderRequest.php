<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'note' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'order_total_price' => 'required|numeric',
            'customer_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'note.required' => 'Trường bắt buộc',
            'address.required' => 'Trường bắt buộc',
            'phone.required' => 'Trường bắt buộc',
            'order_total_price.required' => 'Trường bắt buộc',
            'order_total_price.numeric' => 'Trường bắt buộc nhập số',
            'customer_id.required' => 'Trường bắt buộc',
        ];
    }
}
