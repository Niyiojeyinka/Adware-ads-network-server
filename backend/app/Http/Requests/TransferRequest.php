<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
            "receiver" => "required|string",
            "amount" => "required|integer",
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
