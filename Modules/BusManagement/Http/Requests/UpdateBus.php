<?php

namespace Modules\BusManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBus extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:buses,id',
            'name' => 'required|max:50|string',
            'type' => 'required|max:50|string',
            'vehicle_number' => 'required|string'
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
