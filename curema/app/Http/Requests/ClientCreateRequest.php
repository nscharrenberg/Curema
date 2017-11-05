<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientCreateRequest extends FormRequest
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
            'company' => 'required',
            'country_id' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'address' => 'required',
            'currency_id' => 'required',
//            'primary_contact_id' => 'required',
        ];
    }
}
