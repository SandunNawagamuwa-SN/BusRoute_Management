<?php

namespace Modules\BusRouteManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRoute extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:bus_routes,id',
            'bus_id' => 'required|exists:buses,id',
            'route_id' => 'required|exists:routes,id',
            'status' => 'required|boolean'
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
