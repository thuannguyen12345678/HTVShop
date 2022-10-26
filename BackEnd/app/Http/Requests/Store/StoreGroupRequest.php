<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
          'name' => 'required|unique::groups',
          'description'=>'required'
        ];
    }
    public function messages()
    {
    return [
        'name.required' => 'Trường bắt buộc',
        'description.required' => 'Trường bắt buộc',
        'name.unique' => 'tên đã tồn tại',

    ];
    }
}
