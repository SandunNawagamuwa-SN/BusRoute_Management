<?php

namespace Modules\BookinManagement\Http\Controllers;

use App\Helpers\APIHelpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BookinManagement\Entities\BusScheduleBooking;
use Modules\ScheduleManagement\Entities\BusSchedule;

class BookinManagementController extends Controller
{
    /**
     * Display a listing of the bookings..
     * @return Renderable
     */
    public function allbooking()
    {
        $booking = BusScheduleBooking::all();
        $response = APIHelpers::createAPIResponse(false,200,'',$booking);
        return response()->json($response,200);
    }

    /**
     * Display a listing of the bookings for a particular user.
     * @return Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id; 
        $booking = BusScheduleBooking::where('user_id',$user_id) ->get();
        $response = APIHelpers::createAPIResponse(false,200,'',$booking);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bookinmanagement::create');
    }

    /**
     * 
     * @return Renderable
     */
    public function book($id)
    {
        //currentbookings for that schedule

        $schedulebookings = BusSchedule::find($id);
        return view('bookinmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $booking = new BusScheduleBooking();
        $booking->bus_seate_id = $request->bus_seate_id;
        $booking->user_id = auth()->user()->id;
        $booking->bus_schedule_id = $request->bus_schedule_id;
        $booking->seat_number = $request->seat_number;
        $booking->price = $request->price;
        $booking->status = $request->status
        $booking_save = $booking->save();
        if($booking_save) {
            $response = APIHelpers::createAPIResponse(false,201,'Bus Seat Added Sucsessfully', $booking);
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
        $booking = BusScheduleBooking::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$booking);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bookinmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $booking = BusScheduleBooking::find($id);
        $booking_delete = $booking->delete();
        if($booking_delete) {
            $response = APIHelpers::createAPIResponse(false,200,'Bus seat Deleted Sucsessfully', null);
            return response()->json($response,200);
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Bus seat Deleted failed', null);
            return response()->json($response,400);
        }
    }
}
