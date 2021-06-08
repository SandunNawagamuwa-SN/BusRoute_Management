<?php

namespace Modules\RouteManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\BusRouteManagement\Entities\BusRoute;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'routes';

    protected $fillable = ['node_one','node_two','route_number','distance','time_days','time_hours','time_minutes'];
    
    //protected static function newFactory()
    //{
        //return \Modules\RouteManagement\Database\factories\RouteFactory::new();
    //}

    /**
     * Get the comments for the blog post.
     */
    public function busesroutes()
    {
        return $this->hasMany(BusRoute::class,'route_id');
    }
}
