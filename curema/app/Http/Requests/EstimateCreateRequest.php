<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateCreateRequest extends FormRequest
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
            'date_send' => 'date|Nullable',
            'client_id' => 'required|numeric',
            'project_id' => 'numeric',
            'number' => 'numeric|required|max:2147483647',
            'number_format' => 'numeric',
            'date' => 'date_format:"Y/m/d"|required',
            'deadline' => 'date_format:"Y/m/d"|Nullable',
            'status' => 'numeric',
            'currency_id' => 'numeric|required',
            'subtotal' => 'required',
            'total_tax' => 'required',
            'total' => 'required',
            'adjustment' => 'Nullable',
            'sales_agent' => 'numeric|Nullable',
            'include_shipping' => 'boolean',
            'show_shipping_adress_on_invoice' => 'boolean',
            'show_quantity_as' => 'numeric',
        ];
    }
}
