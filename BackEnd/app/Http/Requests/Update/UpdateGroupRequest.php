<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
                'description'=>'required'

        ];
    }
    public function messages()
    {
    return [
        'name.required' => 'Trường bắt buộc',
        'description.required' => 'Trường bắt buộc',
    ];
    }
}
