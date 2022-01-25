<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'course_id' => 'required|integer',
            'class_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'day_id' => 'required|integer',
            'time_id' => 'required|integer',
            'semester_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'course_id.required' => 'Vui lòng chọn môn học',
            'class_id.required' => 'Vui lòng chọn lớp',
            'teacher_id.required' => 'Vui lòng chọn giáo viên',
            'classroom_id.required' => 'Vui lòng chọn địa điểm',
            'day_id.required' => 'Vui lòng chọn ngày học',
            'time_id.required' => 'Vui lòng chọn thời gian',
            'semester_id.required' => 'Vui lòng chọn kì học',
        ];
    }
}
