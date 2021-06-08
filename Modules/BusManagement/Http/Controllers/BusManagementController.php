<?php

namespace Modules\BusManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BusManagement\Entities\Bus;
use Modules\BusManagement\Http\Requests\StoreBus;
use Modules\BusManagement\Http\Requests\UpdateBus;
//use Modules\BusSeatManagement\Entities\BusSeat;
//use Modules\BusSeatManagement\Entities\BusSeat;

class BusManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $buses = Bus::all();
        $response = APIHelpers::createAPIResponse(false,200,'',$buses);
        return response()->json($response,200);
    }

    /**
     * Display a buses with seats.
     * @return Renderable
     */
    public function buseswithseats()
    {
        $buses = Bus::with('seats') ->get();
        $response = APIHelpers::createAPIResponse(false,200,'',$buses);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Show seats for a bus.
     * @return Renderable
     */
    public function seatforbus($id)
    {
        $bus = Bus::with('seats') ->find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$bus);
        return response()->json($response,200);
    }

    /**
     * Show busroutes for a bus.
     * @return Renderable
     */
    public function busrouteforbus($id)
    {
        $bus = Bus::with('busroutes') ->find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$bus);
        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreBus $request)
    {

        $validated = $request->validated();

        $bus = new Bus();
        $bus->name = $validated['name'];
        $bus->type = $validated['type'];
        $bus->vehicle_number = $validated['vehicle_number'];
        $bus_save = $bus->save();
        if($bus_save) {
            $response = APIHelpers::createAPIResponse(false,201,'Bus Added Sucsessfully', $bus);
            return response()->json($response,201);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Adding failed', null);
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
        $bus = Bus::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$bus);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('busmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBus $request, $id)
    {

        $validated = $request->validated();

        $bus = Bus::find($id);
        $bus->name = $validated['name'];
        $bus->type = $validated['type'];
        $bus->vehicle_number = $validated['vehicle_number'];
        $bus_update = $bus->save();
        if($bus_update) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus Update Sucsessfully', $bus);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Update failed', null);
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
        $bus = Bus::find($id);
        $bus_delete = $bus->delete();
        if($bus_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
