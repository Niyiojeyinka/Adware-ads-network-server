<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'country_id' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'Firstname is required',
            'lastname.required' => 'Lastname is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please Provide a valid Email',
            'email.unique' => 'Email already exists ,pls log in',
            'password.required' => 'Password is Required ',
            'country_id.required' => 'Please Select Country ',
            'password.min' =>
                'Password must be Minimum Number of 4 in character count',
        ];
    }
    /*handle failed validation*/

    public $validator = null;
    protected function failedValidation(
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        $this->validator = $validator;
    }
}