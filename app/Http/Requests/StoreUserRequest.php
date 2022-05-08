<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $rules =  [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|string|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'country' => 'required',
            'municipality' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'type' => 'required',
        
        ];
        return $rules;
    }
}
