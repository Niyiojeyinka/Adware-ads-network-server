<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinRequest extends FormRequest
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
            'pin'=>'required|digits:4|numeric',
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
            'pin.required' => 'Pin is Required',
            'pin.numeric' => 'Pin must be number only',
            'pin.digits'=>'Pin can only be 4-Digit Number only',
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
