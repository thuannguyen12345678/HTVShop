<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
    public function rules() {
        return [
            'path' => 'required|min:3',
        ];
    }
    public function messages()
    {
        return [
            'path.required' => 'Trường bắt buộc',
            'path.min' => 'Trường bắt buộc nhiều hơn 3 ký tự',
        ];
    }
}
