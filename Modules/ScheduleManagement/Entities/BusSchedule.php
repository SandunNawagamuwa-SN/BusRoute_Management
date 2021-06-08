<?php

namespace Modules\ScheduleManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\BookinManagement\Entities\BusScheduleBooking;
use Modules\BusRouteManagement\Entities\BusRoute;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusSchedule extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_schedules';

    protected $fillable = ['bus_route_id', 'direction', 'start_timestamp', 'end_timestamp'];
    
    //protected static function newFactory()
    //{
        //return \Modules\ScheduleManagement\Database\factories\BusScheduleFactory::new();
    //}

    /**
     * Get the schedulebooking record associated with the busseat.
     */
    public function schedulebooks()
    {
        return $this->hasMany(BusScheduleBooking::class,'bus_schedule_id');
    }

    /**
     * Get the post that owns the comment.
     */
    public function busroute()
    {
        return $this->belongsTo(BusRoute::class,'bus_route_id');
    }
}
