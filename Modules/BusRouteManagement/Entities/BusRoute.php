<?php

namespace Modules\BusRouteManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\RouteManagement\Entities\Route;
use Modules\BusManagement\Entities\Bus;
use Modules\ScheduleManagement\Entities\BusSchedule;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusRoute extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_routes';

    protected $fillable = ['bus_id','route_id','status'];
    
    //protected static function newFactory()
    //{
        //return \Modules\BusRouteManagement\Database\factories\BusRouteFactory::new();
    //}

    /**
     * Get the route that owns the busroute.
     */
    public function route()
    {
        return $this->belongsTo(Route::class,'route_id');
    }

    /**
     * Get the bus that owns the busroute.
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class,'bus_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function schedules()
    {
        return $this->hasMany(BusSchedule::class,'bus_route_id');
    }
}
