<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'class_id'            => 'required|integer',
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'email'               =>  ['required', 'email', Rule::unique('students')->ignore($this->request->get('id'))],
            'batch_id'            => 'required|integer',
            'gender'              => 'required|integer|max:255',
            'father_name'         => 'required|string|max:255',
            'father_number'       => 'required|min:11|numeric',
            'mother_name'         => 'required|string|max:255',
            'mother_number'       => 'required|min:11|numeric',
            'dateOfBirth'         => 'required|string|max:255',
            'address'             => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => 'Vui lòng nhập họ học sinh',
            'first_name.required' => 'Vui lòng nhập tên học sinh',
            'email.required' => 'Vui lòng nhập email',
            'batch_id.required' => 'Vui lòng nhập niên khóa',
            'gender.required' => 'Vui lòng nhập giới tính',
            'father_name.required' => 'Vui lòng nhập họ và tên bố',
            'father_number.required' => 'Vui lòng nhập số điện thoại bố',
            'mother_name.required' => 'Vui lòng nhập họ và tên mẹ',
            'mother_number.required' => 'Vui lòng nhập số điện thoại mẹ',
            'dateOfBirth.required' => 'Vui lòng nhập ngày sinh',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Đây không phải là email'
        ];
    }
}
