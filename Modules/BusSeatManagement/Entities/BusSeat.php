<?php

namespace Modules\BusSeatManagement\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusSeat extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_seates';

    protected $fillable = ['bus_id','seat_number','price'];
    
    //protected static function newFactory()
    //{
        //return \Modules\BusSeatManagement\Database\factories\BusSeatFactory::new();
    //}

    /**
     * Get the schedulebooking record associated with the busseat.
     */
    public function schedulebookings()
    {
        return $this->hasMany('Modules\BookinManagement\BusScheduleBooking','bus_seates_id');
    }

    /**
     * Get the bus that owns the seat.
     */
    public function bus()
    {
        return $this->belongsTo('Modules\BusManagement\Bus','bus_id');
    }
}
