<?php

namespace Modules\RouteManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\RouteManagement\Entities\Route;
use Modules\RouteManagement\Http\Requests\StoreRoute;
use Modules\RouteManagement\Http\Requests\UpdateRoute;

class RouteManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $routes = Route::all();
        $response = APIHelpers::createAPIResponse(false,200,'',$routes);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('routemanagement::create');
    }

    /**
     * Show busroutes for a route.
     * @return Renderable
     */
    public function busrouteforroutes($id)
    {
        $busesroutes = Route::with('busesroutes') ->find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$busesroutes);
        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRoute $request)
    {
        $validated = $request->validated();

        $route = new Route();
        $route->node_one = $validated['node_one'];
        $route->node_two = $validated['node_two'];
        $route->route_number = $validated['route_number'];
        $route->distance = $validated['distance'];
        $route->time_days = $validated['time_days'];
        $route->time_hours = $validated['time_hours'];
        $route->time_minutes = $validated['time_minutes'];
        $route_save = $route->save();
        if($route_save) {
            $response = APIHelpers::createAPIResponse(false,201,'Route Added Sucsessfully', null);
            return response()->json($response,201);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Route Adding failed',null);
            return response()->json($response,400);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $route = Route::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$route);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('routemanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateRoute $request, $id)
    {
        $validated = $request->validated();

        $route = Route::find($id);
        $route->node_one = $validated['node_one'];
        $route->node_two = $validated['node_two'];
        $route->route_number = $validated['route_number'];
        $route->distance = $validated['distance'];
        $route->time_days = $validated['time_days'];
        $route->time_hours = $validated['time_hours'];
        $route->time_minutes = $validated['time_minutes'];
        $route_update = $route->save();
        if($route_update) {
            $response = APIHelpers::createAPIResponse(false,200,'Route Update Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Route Update failed', null);
            return response()->json($response,400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $route = Route::find($id);
        $route_delete = $route->delete();
        if($route_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'Route Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Route Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
