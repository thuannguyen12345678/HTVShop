<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|number',
            'address' => 'required',
            'day_of_birth' => 'required',
            'group_id'=>'required'
        ];
    }
    public function messages()
    {
    return [
        'email.required' => 'Trường bắt buộc',
        'name.required' => 'Trường bắt buộc',
        'address.required' => 'Trường bắt buộc',
        'phone.required' => 'Trường bắt buộc',
        'address.required' => 'Trường bắt buộc',
        'day_of_birth.required' => 'Trường bắt buộc',
        'group_id.required' => 'Trường bắt buộc',
        'email.email' => 'Email không đúng định dạng',
    ];
    }
}
