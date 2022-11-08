<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:admins,email|email',
            'password' => 'required|confirmed',
            'status' => 'required',
            'role' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'please enter name',
            'email.required' => 'please enter email',
            'email.unique' => 'this email already exists, please try another!!',
            'email.email' => 'email must be valide format',
            'password.required' => 'plase enter password',
            'password.confirmed' => 'confirm password does not match',
            'role.required' => 'please select a role',
            'status.required' => 'please select a status'
        ];
    }
}
