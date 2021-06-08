<?php

namespace Modules\BookinManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBooking extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bus_seat_id' => 'required|exists:bus_seates,id',
            'bus_schedule_id' => 'required|exists:bus_schedules,id'
            'seat_number' => 'required|exists:bus_seates,seat_number'
            'price'
            'status'
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
