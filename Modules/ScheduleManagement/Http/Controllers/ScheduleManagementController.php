<?php

namespace Modules\ScheduleManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ScheduleManagement\Entities\BusSchedule;
use Modules\ScheduleManagement\Http\Requests\StoreSchedule;
use Modules\ScheduleManagement\Http\Requests\UpdateSchedule;

class ScheduleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $schedulees = BusSchedule::all();
        $response = APIHelpers::createAPIResponse(false,200,'',$schedulees);
        return response()->json($response,200);
    }

    /**
     * Show busroutes for a busschedule.
     * @return Renderable
     */
    public function busroutesforschedule($id)
    {
        $busroutes = BusSchedule::with('busroute') ->find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$busroutes);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('schedulemanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreSchedule $request)
    {

        $validated = $request->validated();

        $schedule = new BusSchedule();
        $schedule->bus_route_id = $validated['bus_route_id'];
        $schedule->direction = $validated['direction'];
        $schedule->start_timestamp = $validated['start_timestamp'];
        $schedule->end_timestamp = $validated['end_timestamp'];
        $schedule_save = $schedule->save();
        if($schedule_save) {
            $response = APIHelpers::createAPIResponse(false,201,'BusSchedule Added Sucsessfully', $schedule);
            return response()->json($response,201);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'BusSchedule Adding failed', null);
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
        $schedule = BusSchedule::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$schedule);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('schedulemanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSchedule $request, $id)
    {

        $validated = $request->validated();

        $schedule = BusSchedule::find($id);
        $schedule->bus_route_id = $request->bus_route_id;
        $schedule->direction = $request->direction;
        $schedule->start_timestamp = $request->start_timestamp;
        $schedule->end_timestamp = $request->end_timestamp;
        $schedule_update = $schedule->save();
        if($schedule_update) {
            $response = APIHelpers::createAPIResponse(false,200,'BusSchedule Update Sucsessfully', $schedule);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'BusSchedule Update failed', null);
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
        $schedule = BusSchedule::find($id);
        $schedule_delete = $schedule->delete();
        if($schedule_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'BusSchedule Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'BusSchedule Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
