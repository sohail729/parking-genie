<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParkingDetailRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'will_host_greet' => 'required',
            'has_surveillance' => 'required',
            'base_price' => 'required',
            'session_start' => 'required',            
            'session_end' => 'required',            
            'earliest_reservation' => 'required',            
            'lastest_reservation' => 'required',             
            'space_category' => 'required',             
            'vehicle_category' => 'required',             
            'images' => 'required',             
        ];

        return $rules;
    }
}
