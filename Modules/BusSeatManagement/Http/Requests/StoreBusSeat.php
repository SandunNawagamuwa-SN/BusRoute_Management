<?php

namespace Modules\BusSeatManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusSeat extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bus_id' => 'required|max:15|exists:buses,id',
            'seat_number' => 'required|numeric|min:0',
            'price' => 'required|between:0,999999.99'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
