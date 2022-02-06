<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherControllerRequest extends FormRequest
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
            'teacher_name'        => 'required|string|max:255',
            'email'               => ['required', 'email', Rule::unique('teachers')->ignore($this->request->get('id'))],
            'gender'              => 'required|string|max:255',
            'mobileNumber'        => 'required|min:11|numeric',
            'dateOfBirth'         => 'required|string|max:255',
            'address'             => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'teacher_name.required' => 'Vui lòng nhập tên giáo viên',
            'email.required' => 'Vui lòng nhập email giáo viên',
            'gender.required' => 'Vui lòng nhập giới tính',
            'mobileNumber.required' => 'Vui lòng nhập số điện thoại',
            'dateOfBirth.required' => 'Vui lòng nhập ngày sinh',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'email.unique' => 'Email đã được sử dụng'
        ];
    }
}
