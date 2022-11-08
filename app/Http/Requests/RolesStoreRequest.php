<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesStoreRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'please enter name',
            'name.unique' => 'This roles already exists, please try another',
            'status.required' => 'please enter status'
        ];
    }
}
