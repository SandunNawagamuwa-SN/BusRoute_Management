<?php

namespace Modules\ScheduleManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedule extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bus_route_id' => 'required|max:50|string|exists:bus_routes,id',
            'direction' => 'required|boolean',
            'start_timestamp' => 'required|date_format:Y-m-d H:i:s',
            'end_timestamp' => 'required|date_format:Y-m-d H:i:s|after:start_timestamp'
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
