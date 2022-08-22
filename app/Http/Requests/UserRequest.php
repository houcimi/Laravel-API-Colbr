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
        return [
            'prenom'=>'required',
            'nom'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'prenom.required' => 'Name is required!',
            'nom.required' => 'Email is required!',
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
