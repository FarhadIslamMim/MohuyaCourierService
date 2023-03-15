<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Deliveryman;
use App\Models\DeliverymanAttendence;
use App\Models\Employee;
use App\Models\Pickupman;
use App\Models\PickupmanAttendence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->all();
        $attendences = [];
        $selection = $request->selection;

        // return $selection;

        $employees = Employee::select('id', 'name')->get();
        $deliverymans = Deliveryman::select('id', 'name')->get();
        $pickupmans = Pickupman::select('id', 'name')->get();

        switch ($selection) {
            case 1:

                if ($request->start_date == !null && $request->end_date == !null) {
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;

                    $attendences = Attendence::where('employee_id', $request->employee_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->orderBy('id', 'DESC')->get();
                }
                break;
            case 2:
                if ($request->start_date == !null && $request->end_date == !null) {

                    $start_date = $request->start_date;
                    $end_date = $request->end_date;

                    $attendences = DeliverymanAttendence::where('deliveryman_id', $request->deliveryman_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->orderBy('id', 'DESC')->get();
                }
                break;
            case 3:
                if ($request->start_date == !null && $request->end_date == !null) {
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;

                    $attendences = PickupmanAttendence::where('pickupman_id', $request->pickupman_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->orderBy('id', 'DESC')->get();
                }
                break;
        }
        // else if($request->start_date !== NULL && $request->end_date == NULL){
        //     $attendences = Attendence::where('employee_id', $request->employee_id)->whereDate('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->get();
        // }

        // return $attendences;
        return view('backend.pages.superadmin.attendence.manage', compact('attendences', 'employees', 'pickupmans', 'deliverymans', 'selection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //get employee list
        $attendences = [];

        $selection = $request->selection;
        $employees = [];

        $date = $request->date;
        // return $date;
        switch ($selection) {
            case 1:
                $data_exists = Attendence::where('date', $request->date)->first();

                if ($data_exists) {
                    $attendences = Attendence::where('date', $request->date)->with('employeData')->get();
                }
                $employees = Employee::select('id', 'name', 'phone')->where('status', 1)->get();
                $date = $request->date;
                break;

            case 2:
                $data_exists = DeliverymanAttendence::where('date', $request->date)->first();

                if ($data_exists) {
                    $attendences = DeliverymanAttendence::where('date', $request->date)->with('employeData')->get();
                }
                $employees = Deliveryman::select('id', 'name', 'phone')->where('status', 1)->get();
                $date = $request->date;
                break;
            case 3:
                $data_exists = PickupmanAttendence::where('date', $request->date)->first();

                if ($data_exists) {
                    $attendences = PickupmanAttendence::where('date', $request->date)->with('employeData')->get();
                }
                $employees = Pickupman::select('id', 'name', 'phone')->where('status', 1)->get();
                $date = $request->date;
                break;
        }


        return view('backend.pages.superadmin.attendence.attendence', compact('employees', 'date', 'attendences', 'selection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selection = $request->selection;

        // return $selection;

        switch ($selection) {
            case 1:
                $data_exists = Attendence::where('date', $request->date)->first();
                if ($data_exists) {
                    $attendences = Attendence::where('date', $request->date)->with('employeData')->get();
                    // return $attendences;

                    return redirect()->back()->with('error', 'Attendence Already taken');
                }

                foreach ($request->employee_id ?? [] as $key => $employee_id) {
                    $data = [
                        'employee_id' => $employee_id,
                        'status' => $request->status[$employee_id],
                        'starttime' => $request->starttime[$employee_id],
                        'endtime' => $request->endtime[$employee_id],
                        'date' => $request->date,
                        'note' => $request->note[$employee_id],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    // check if exists
                    $exists = Attendence::where(['employee_id' => $employee_id, 'date' => $request->date])->exists();
                    $attendences = Attendence::where('date', $request->date)->get();
                    if ($exists == true) {
                        return back()->with($attendences);
                    } else {
                        Attendence::insert($data);
                    }
                }
                return back()->with('success', 'Attendence for today is taken');
                break;

            case 2:
                $data_exists = DeliverymanAttendence::where('date', $request->date)->first();
                if ($data_exists) {
                    $attendences = DeliverymanAttendence::where('date', $request->date)->with('employeData')->get();
                    // return $attendences;

                    return redirect()->back()->with('error', 'Deliveryman Attendence Already taken');
                }

                foreach ($request->employee_id ?? [] as $key => $employee_id) {
                    $data = [
                        'deliveryman_id' => $employee_id,
                        'status' => $request->status[$employee_id],
                        'starttime' => $request->starttime[$employee_id],
                        'endtime' => $request->endtime[$employee_id],
                        'date' => $request->date,
                        'note' => $request->note[$employee_id],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    // check if exists
                    $exists = DeliverymanAttendence::where(['deliveryman_id' => $employee_id, 'date' => $request->date])->exists();
                    $attendences = DeliverymanAttendence::where('date', $request->date)->get();
                    if ($exists == true) {
                        return back()->with($attendences);
                    } else {
                        DeliverymanAttendence::insert($data);
                    }
                }

                return back()->with('success', 'Attendence for today is taken');
                break;
            case 3:
                $data_exists = PickupmanAttendence::where('date', $request->date)->first();
                if ($data_exists) {
                    $attendences = PickupmanAttendence::where('date', $request->date)->with('employeData')->get();
                    // return $attendences;

                    return redirect()->back()->with('error', 'Pickupman Attendence Already taken');
                }

                foreach ($request->employee_id ?? [] as $key => $employee_id) {
                    $data = [
                        'pickupman_id' => $employee_id,
                        'status' => $request->status[$employee_id],
                        'starttime' => $request->starttime[$employee_id],
                        'endtime' => $request->endtime[$employee_id],
                        'date' => $request->date,
                        'note' => $request->note[$employee_id],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    // check if exists
                    $exists = PickupmanAttendence::where(['pickupman_id' => $employee_id, 'date' => $request->date])->exists();
                    $attendences = PickupmanAttendence::where('date', $request->date)->get();
                    if ($exists == true) {
                        return back()->with($attendences);
                    } else {
                        PickupmanAttendence::insert($data);
                    }
                }
                return back()->with('success', 'Pickupman Attendence for today is taken');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $selection = $request->selection;
        // return $request->all();
        switch ($selection) {
            case 1:
                foreach ($request->id ?? [] as $key => $ids) {
                    $data = [
                        'status' => $request->status[$ids],
                        'starttime' => $request->starttime[$ids],
                        'endtime' => $request->endtime[$ids],
                        'date' => $request->date,
                        'note' => $request->note[$ids],
                        'updated_at' => Carbon::now(),
                    ];

                    Attendence::where('id', $ids)->update($data);
                }
                return back()->with('success', 'Attendence Updated');

                break;
            case 2:


                foreach ($request->id ?? [] as $key => $ids) {
                    // return $request->status[$ids];
                    $data = [
                        'status' => $request->status[$ids],
                        'starttime' => $request->starttime[$ids],
                        'endtime' => $request->endtime[$ids],
                        'date' => $request->date,
                        'note' => $request->note[$ids],
                        'updated_at' => Carbon::now(),
                    ];

                    DeliverymanAttendence::where('id', $ids)->update($data);
                }
                return back()->with('success', 'Attendence Updated');


                break;
            case 3:
                foreach ($request->id ?? [] as $key => $ids) {
                    $data = [
                        'status' => $request->status[$ids],
                        'starttime' => $request->starttime[$ids],
                        'endtime' => $request->endtime[$ids],
                        'date' => $request->date,
                        'note' => $request->note[$ids],
                        'updated_at' => Carbon::now(),
                    ];

                    PickupmanAttendence::where('id', $ids)->update($data);
                }
                return back()->with('success', 'Attendence Updated');

                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
