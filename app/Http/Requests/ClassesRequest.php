<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'class_name' => 'required|string|max:255',
            'group_id' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'class_name.required' => 'Vui lòng nhập tên lớp',
            'group_id.required' => 'Vui lòng chọn khối lớp'
        ];
    }
}
