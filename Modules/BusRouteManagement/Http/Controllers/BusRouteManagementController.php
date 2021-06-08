<?php

namespace Modules\BusRouteManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BusRouteManagement\Entities\BusRoute;
use Modules\BusRouteManagement\Http\Requests\StoreBusRoute;
use Modules\BusRouteManagement\Http\Requests\UpdateBusRoute;

class BusRouteManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $busroutes = BusRoute::all();
        $response = APIHelpers::createAPIResponse(false,200,'',$busroutes);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('busroutemanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreBusRoute $request)
    {
        $validated = $request->validated();

        $busroute = new BusRoute();
        $busroute->bus_id = $validated['bus_id'];
        $busroute->route_id = $validated['route_id'];
        $busroute->status = $validated['status'];
        $busroute_save = $busroute->save();
        if($busroute_save) {
            $response = APIHelpers::createAPIResponse(false,201,'Bus Route Added Sucsessfully', $busroute);
            return response()->json($response,201);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Route Adding failed', null);
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
        $busroute = BusRoute::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$busroute);
        return response()->json($response,200);
    }

    /**
     * Show buses for specified busroute.
     * @param int $id
     * @return Renderable
     */
    public function showbuses($id)
    {
        $busesforbsroute = BusRoute::with('bus')->find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$busesforbsroute);
        return response()->json($response,200);
    }

    /**
     * Show routes for specified busroute.
     * @param int $id
     * @return Renderable
     */
    public function showroutes($id)
    {
        $routesforbsroute = BusRoute::with('route')->find($id);
        //$routesforbsroute = $id;
        $response = APIHelpers::createAPIResponse(false,200,'',$routesforbsroute);
        return response()->json($response,200);
    }

    /**
     * Show routes for specified busroute.
     * @param int $id
     * @return Renderable
     */
    public function showschedules($id)
    {
        $schedulesforbsroute = BusRoute::with('schedules')->find($id);
        //$routesforbsroute = $id;
        $response = APIHelpers::createAPIResponse(false,200,'',$schedulesforbsroute);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('busroutemanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBusRoute $request, $id)
    {
        $validated = $request->validated();

        $busroute = BusRoute::find($id);
        $busroute->bus_id = $validated['bus_id'];
        $busroute->route_id = $validated['route_id'];
        $busroute->status = $validated['status'];
        $busroute_update = $busroute->save();
        if($busroute_update) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus Route Update Sucsessfully', $busroute);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Route Update failed', null);
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
        $busroute = BusRoute::find($id);
        $busroute_delete = $busroute->delete();
        if($busroute_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus Route Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Route Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
