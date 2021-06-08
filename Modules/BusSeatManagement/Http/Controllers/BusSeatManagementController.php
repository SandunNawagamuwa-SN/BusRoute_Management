<?php

namespace Modules\BusSeatManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BusSeatManagement\Entities\BusSeat;
use Modules\BusSeatManagement\Http\Requests\StoreBusSeat;
use Modules\BusSeatManagement\Http\Requests\UpdateBusSeat;

class BusSeatManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('busseatmanagement::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('busseatmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreBusSeat $request)
    {
        $validated = $request->validated();

        $busseat = new BusSeat();
        $busseat->bus_id = $validated['bus_id'];
        $busseat->seat_number = $validated['seat_number'];
        $busseat->price = $validated['price'];
        $busseat_save = $busseat->save();
        if($busseat_save) {
            $response = APIHelpers::createAPIResponse(false,201,'Bus Seat Added Sucsessfully', $busseat);
            return response()->json($response,201);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Seat Adding failed', null);
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
        $busseat = BusSeat::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$busseat);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('busseatmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBusSeat $request, $id)
    {
        $validated = $request->validated();

        $busseat = BusSeat::find($id);
        $busseat->bus_id = $validated['bus_id'];
        $busseat->seat_number = $validated['seat_number'];
        $busseat->price = $validated['price'];
        $busseat_update = $busseat->save();
        if($busseat_update) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus Seat Update Sucsessfully', $busseat);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus Seat Update failed', null);
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
        $busseat = BusSeat::find($id);
        $busseat_delete = $busseat->delete();
        if($busseat_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus seat Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus seat Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
