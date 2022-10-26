<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'avatar' => 'required',
            'phone' => 'required|number',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'ward_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc',
            'avatar.required' => 'Trường bắt buộc',
            'phone.required' => 'Trường bắt buộc',
            'email.required' => 'Trường bắt buộc',
            'password.required' => 'Trường bắt buộc',
            'district_id.required' => 'Trường bắt buộc',
            'province_id.required' => 'Trường bắt buộc',
            'ward_id.required' => 'Trường bắt buộc',
            'email.unique' => 'Email đã bị trùng',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
