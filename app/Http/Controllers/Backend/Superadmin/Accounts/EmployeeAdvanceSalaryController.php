<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use App\Models\DeliverymanAdvance;
use App\Models\Employee;
use App\Models\EmployeeAdvanceSalary;
use App\Models\Pickupman;
use App\Models\PickupmanAdvance;
use Illuminate\Http\Request;

class EmployeeAdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();

        $data = 0;
        $selection = 0;
        $date = $request->date;
        $employee_id = $request->employee_id;
        $employees = Employee::select('id', 'name')->get();
        $deliverymans = Deliveryman::select('id', 'name')->get();
        $pickupmans = Pickupman::select('id', 'name')->get();
        $advance_salary = 0;
        switch ($request->selection) {
            case 1:
                $data = Employee::where('id', $request->employee_id)->with('advanceSalary')->get();
                $selection = $request->selection;
                break;
            case 2:
                $data = Deliveryman::where('id', $request->deliveryman_id)->with('advanceSalary')->get();
                $selection = $request->selection;
                break;
            case 3:
                $data = Pickupman::where('id', $request->pickupman_id)->with('advanceSalary')->get();
                $selection = $request->selection;
                break;
        }

        return view('backend.pages.superadmin.accounts.salary.advance_salary', compact('employees', 'data', 'date', 'advance_salary', 'pickupmans', 'deliverymans', 'selection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'advance_amount' => 'required',
        ]);

        switch ($request->selection) {
            case '1':
                $as = new EmployeeAdvanceSalary();
                $as->employee_id = $request->employee_id;
                $as->advance_date = $request->advance_date;
                $as->advance_amount = $request->advance_amount;
                $as->save();

                return redirect()->back()->with('success', 'Advance money successfully taken');
                break;
            case '2':
                $as = new DeliverymanAdvance();
                $as->deliveryman_id = $request->employee_id;
                $as->advance_date = $request->advance_date;
                $as->advance_amount = $request->advance_amount;
                $as->save();

                return redirect()->back()->with('success', 'Advance money successfully taken');
                break;
            case '3':
                $as = new PickupmanAdvance();
                $as->pickupman_id = $request->employee_id;
                $as->advance_date = $request->advance_date;
                $as->advance_amount = $request->advance_amount;
                $as->save();

                return redirect()->back()->with('success', 'Advance money successfully taken');
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
    public function update(Request $request, $id)
    {
        //
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
