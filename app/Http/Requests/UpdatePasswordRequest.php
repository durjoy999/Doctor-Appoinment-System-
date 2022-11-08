<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'email' => 'required|exists:password_resets,email',
            'token' => 'required',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'please enter your email',
            'email.exists' => 'email is not exists in system',
            'token.required' => 'token is invalid',
            'password.required' => 'please enter your password',
            'pasword.confirmed' => 'confirm password does not match'
        ];
    }
}
