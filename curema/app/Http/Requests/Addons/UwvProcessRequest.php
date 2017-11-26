<?php

namespace App\Http\Requests\Addons;

use Illuminate\Foundation\Http\FormRequest;

class UwvProcessRequest extends FormRequest
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
            'ordernr' => 'required',
            'uwv_service_id' => 'required|numeric',
            'start_date' => 'date_format:"Y/m/d"|required',
            'client_id' => 'required|numeric',
            'contacts' => 'required'
        ];
    }
}
