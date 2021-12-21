<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'                => 'required|string|max:255',
            'email'               => 'required|string|email',
            'batch_id'            => 'required|integer',
            'class_id'            => 'required|integer',
            'gender'              => 'required|integer|max:255',
            'father_name'         => 'required|string|max:255',
            'father_number'       => 'required|min:11|numeric',
            'mother_name'         => 'required|string|max:255',
            'mother_number'       => 'required|min:11|numeric',
            'dateOfBirth'         => 'required|string|max:255',
            'address'             => 'required|string|max:255',
            'upload'              => 'required|image',
        ];
    }
}
