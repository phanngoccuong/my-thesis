<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonPlanRequest extends FormRequest
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
            'class_id' => 'required',
            'semester_id' => 'required',
            'course_id' => 'required',
            'date' => 'required',
            'title' => 'required'
        ];
    }
}
