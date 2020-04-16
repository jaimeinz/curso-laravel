<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDomicilioRequest extends FormRequest
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
        if($this->method()=='POST') {
            return [
                'user_id' => 'required|integer',
                'calle' => 'required|string',
                'colonia' => 'required|string',
                'cp' => 'required|string',
            ];
        }
        if($this->method()=='PUT') {
            return [
                'calle' => 'string',
                'colonia' => 'string',
                'cp' => 'string'
            ];
        }
    }
}
