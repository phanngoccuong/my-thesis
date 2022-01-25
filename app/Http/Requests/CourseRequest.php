<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'course_name' => 'required|string|max:255',
            'group_id' => 'required|integer',
            'is_point' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'course_name.required' => 'Vui lòng nhập tên môn học',
            'group_id.required' => 'Vui lòng nhập khối lớp',
            'is_point.required' => 'Vui lòng nhập cách tính điểm'
        ];
    }
}
