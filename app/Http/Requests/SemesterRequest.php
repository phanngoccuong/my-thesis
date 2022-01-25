<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
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
            'semester_name' => 'required|string|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'semester_name.required' => 'Vui lòng nhập học kì',
            'start_date.required' => 'Vui lòng nhập thời gian bắt đầu',
            'end_date.required' => 'Vui lòng nhập thời gian kết thúc',
        ];
    }
}
