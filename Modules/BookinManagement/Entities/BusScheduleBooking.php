<?php

namespace Modules\BookinManagement\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusScheduleBooking extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_schedule_bookings';

    protected $fillable = ['bus_seate_id','user_id','bus_schedule_id','seat_number','price','status'];
    
    /*protected static function newFactory()
    {
        return \Modules\BookinManagement\Database\factories\BusScheduleBookingFactory::new();
    }*/
    
    /**
     * Get the seat that owns the schedulebooking.
     */
    public function seat()
    {
        return $this->belongsTo('Modules\BusSeatManagement\BusSeat','bus_seat_id');
    }

    /**
     * Get the user that owns the schedulebooking.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
     * Get the schedule that owns the schedulebooking.
     */
    public function schedule()
    {
        return $this->belongsTo('Modules\ScheduleManagement\BusSchedule','bus_schedule_id');
    }
}
