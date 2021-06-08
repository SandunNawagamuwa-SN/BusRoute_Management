<?php

namespace Modules\BusManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\BusSeatManagement\Entities\BusSeat;
use Modules\BusRouteManagement\Entities\BusRoute;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buses';

    protected $fillable = ['name', 'type', 'vehicle_number'];
    
    //protected static function newFactory()
    //{
        //return \Modules\BusManagement\Database\factories\BusFactory::new();
    //}

    /**
     * Get the busSeates for the bus.
     */
    public function seats()
    {
        return $this->hasMany(BusSeat::class,'bus_id');
    }

    /**
     * The routes that belong to the bus.
     */
    public function busroutes()
    {
        return $this->hasMany(BusRoute::class,'bus_id');
    }
}
