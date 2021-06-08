<?php

namespace Modules\RouteManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoute extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:routes,id',
            'node_one' => 'required|max:100|string',
            'node_two' => 'required|max:100|string',
            'route_number' => 'required|numeric',
            'distance' => 'required|numeric|min:0',
            'time_days' => 'required|numeric',
            'time_hours' => 'required|numeric',
            'time_minutes' => 'required|numeric'
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
