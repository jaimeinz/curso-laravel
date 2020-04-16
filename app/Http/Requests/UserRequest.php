<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string',
                'name' => 'required|string',
                'telefono' => 'required|string'
            ];
        }
        if($this->method()=='PUT') {
            return [
                'name' => 'string',
                'email' => 'email|unique:users,email',
                'telefono' => 'string'
            ];
        }
    }
}
