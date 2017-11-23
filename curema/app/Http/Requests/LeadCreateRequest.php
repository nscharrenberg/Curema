<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadCreateRequest extends FormRequest
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
            'email' => 'required|email',
            'company' => 'required',
            'title' => 'Nullable',
            'description' => 'Nullable',
            'website' => 'Nullable',
            'phonenumber' => 'Nullable',
            'country_id' => 'Nullable',
            'state' => 'Nullable',
            'city' => 'Nullable',
            'address' => 'Nullable',
            'zipcode' => 'Nullable',
            'assigned_to' => 'numeric|required',
            'status_id' => 'numeric|required',
            'source_id' => 'numeric|required',
            'last_contact' => 'date_format:"Y/m/d hh:mm"|Nullable',
            'last_status_change' => 'date_format:"Y/m/d hh:mm"|Nullable',
            'default_language' => 'required|numeric',
            'client_id' => 'numeric|Nullable',
            'lost_lead' => 'numeric|Nullable',
            'public' => 'Nullable'
        ];
    }
}
