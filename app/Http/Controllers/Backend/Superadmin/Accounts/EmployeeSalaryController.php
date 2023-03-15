<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Deliveryman;
use App\Models\DeliverymanAdvance;
use App\Models\DeliverymanAttendence;
use App\Models\DeliveryManSalary;
use App\Models\DeliverySalaryInvoice;
use App\Models\Employee;
use App\Models\EmployeeAdvanceSalary;
use App\Models\EmployeeSalarInvoice;
use App\Models\EmployeeSalary;
use App\Models\Parcel;
use App\Models\Pickupman;
use App\Models\PickupmanAdvance;
use App\Models\PickupmanAttendence;
use App\Models\PickupmanSalary;
use App\Models\PickupmanSalaryInvoice;
use Carbon\Carbon;
use DateTime;
use Faker\Core\Number;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->salary_year;
        $month = $request->month;
        $employee_id = $request->employee_id;
        $employees = Employee::select('id', 'name')->get();
        $deliverymans = Deliveryman::select('id', 'name')->get();
        $pickupmans = Pickupman::select('id', 'name')->get();
        $salary_sheets = [];
        $sheets = [];
        $selection = $request->selection;

        switch ($request->selection) {
            case 1:
                if ($year && $month) {
                    $sheets = EmployeeSalarInvoice::where(['year' => $year, 'month' => $month])->get();
                    // return $sheets;
                } else {
                    $salary_sheets = EmployeeSalarInvoice::get();
                }
                break;
            case 2:
                if ($year && $month) {
                    $sheets = DeliverySalaryInvoice::where(['year' => $year, 'month' => $month])->get();
                    // return $sheets;
                } else {
                    $salary_sheets = DeliverySalaryInvoice::with('getDeliveryman')->get();
                }
                break;
            case 3:
                if ($year && $month) {
                    $sheets = PickupmanSalaryInvoice::where(['year' => $year, 'month' => $month])->get();
                    // return $sheets;
                } else {
                    $salary_sheets = PickupmanSalaryInvoice::get();
                }
                break;
        }

        return view('backend.pages.superadmin.accounts.salary.salary', compact('salary_sheets', 'sheets', 'selection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        $Orginal_month = $request->month;
        $salary_year = $request->salary_year;
        $advance_salary = 0;

        $employees_datas = [];

        $salary_message = [];

        switch ($request->selection) {
            case '1':
                if ($request->salary_year != null && $request->month != null) {
                    $employees = Employee::select('name', 'id', 'phone', 'gross_salary')->with('advanceSalary')->get();
                    // return $employees;
                    foreach ($employees as  $employee) {
                        $employeess = EmployeeSalary::where([
                            'year' => $request->salary_year,
                            'month' => $request->month, 'employee_id' => $employee->id,
                        ])
                            ->with('getEmployees')->first();
                        // return $employeess;

                        $month = Carbon::parse($request->month)->month;
                        $year = $request->salary_year;
                        $date = $year . "-" . $month;
                        $date_from = date('Y-m-01', strtotime($date));
                        $date_to = date('Y-m-t', strtotime($date));



                        $absent_day = Attendence::where([
                            'employee_id' => $employee->id,
                            'status' => 'Absent',
                        ])->whereBetween('date', [$date_from, $date_to])->get();


                        $absent_day_final =  count($absent_day);
                        $deduction = $employee->gross_salary / 31;
                        $amount = intval($deduction * $absent_day_final);
                        // return $amount;
                        $temp = [];

                        if (!empty($employeess)) {
                            $employee_id = $employee->id;
                            $message = 'Salary already created';
                            $temp['name'] = $employee->name;
                            $temp['id'] = $employee_id;
                            $temp['message'] = $message;
                            $temp['selection'] = $request->selection;
                            $temp['exists'] = true;
                            array_push($salary_message, $temp);
                        } else {
                            $name = $employee->name;
                            $id = $employee->id;
                            $advance_salary = $employee->advanceSalary->sum('advance_amount');
                            $temp['name'] = $name;
                            $temp['id'] = $id;
                            $temp['selection'] = $request->selection;
                            $temp['advance_salary'] = $advance_salary;
                            $temp['fine'] = $amount;
                            $temp['comission'] = 0;
                            $temp['absent_days'] = $absent_day_final;
                            $temp['gross_salary'] = $employee->gross_salary;
                            $temp['exists'] = false;

                            array_push($salary_message, $temp);
                        }
                    }
                }
                break;
            case '2':
                if ($request->salary_year != null && $request->month != null) {
                    $deliverymans = Deliveryman::select('name', 'id', 'phone', 'gross_salary')->with('advanceSalary')->get();
                    // return $employees;

                    foreach ($deliverymans as  $deliveryman) {
                        $employeess = DeliveryManSalary::where(['year' => $request->salary_year, 'month' => $request->month, 'deliveryman_id' => $deliveryman->id])->first();
                        // return $employeess;

                        $month = Carbon::parse($request->month)->month;
                        $year = $request->salary_year;
                        $date = $year . "-" . $month;
                        $date_from = date('Y-m-01', strtotime($date));
                        $date_to = date('Y-m-t', strtotime($date));

                        $percel_amount = Parcel::where('deliverymanId', $deliveryman->id)->select('deliveryman_due')->get();
                        $comission =  $percel_amount->sum('deliveryman_due');

                        $absent_day = DeliverymanAttendence::where([
                            'deliveryman_id' => $deliveryman->id,
                            'status' => 'Absent',
                        ])->whereBetween('date', [$date_from, $date_to])->get();

                        $absent_day_final =  count($absent_day);
                        $deduction = $deliveryman->gross_salary / 31;
                        $amount = intval($deduction * $absent_day_final);

                        // return $absent_day_final;

                        $temp = [];

                        if (!empty($employeess)) {
                            $employee_id = $deliveryman->id;
                            $message = 'Salary already created';
                            $temp['name'] = $deliveryman->name;
                            $temp['id'] = $employee_id;
                            $temp['message'] = $message;
                            $temp['selection'] = $request->selection;
                            $temp['exists'] = true;
                            array_push($salary_message, $temp);
                        } else {
                            $name = $deliveryman->name;
                            $id = $deliveryman->id;
                            $advance_salary = $deliveryman->advanceSalary->sum('advance_amount');
                            $temp['name'] = $name;
                            $temp['id'] = $id;
                            $temp['selection'] = $request->selection;
                            $temp['advance_salary'] = $advance_salary;
                            $temp['fine'] = $amount;
                            $temp['comission'] = $comission;
                            $temp['absent_days'] = $absent_day_final;
                            $temp['gross_salary'] = $deliveryman->gross_salary;
                            $temp['exists'] = false;

                            array_push($salary_message, $temp);
                        }
                    }
                }
                break;
            case '3':
                if ($request->salary_year != null && $request->month != null) {
                    $pickupmans = Pickupman::select('name', 'id', 'phone', 'gross_salary')->with('advanceSalary')->get();
                    // return $employees;

                    foreach ($pickupmans as  $pickupman) {
                        $employeess = PickupmanSalary::where(['year' => $request->salary_year, 'month' => $request->month, 'pickupman_id' => $pickupman->id])->first();
                        // return $employeess;
                        $temp = [];

                        $percel_amount = Parcel::where('pickupmanId', $pickupman->id)->select('pickupman_due')->get();
                        $comission =  $percel_amount->sum('pickupman_due');

                        $month = Carbon::parse($request->month)->month;
                        $year = $request->salary_year;
                        $date = $year . "-" . $month;
                        $date_from = date('Y-m-01', strtotime($date));
                        $date_to = date('Y-m-t', strtotime($date));
                        $absent_day = PickupmanAttendence::where([
                            'pickupman_id' => $pickupman->id,
                            'status' => 'Absent',
                        ])->whereBetween('date', [$date_from, $date_to])->get();

                        $absent_day_final =  count($absent_day);
                        $deduction = $pickupman->gross_salary / 31;
                        $amount = intval($deduction * $absent_day_final);

                        if (!empty($employeess)) {
                            $employee_id = $pickupman->id;
                            $message = 'Salary already created';
                            $temp['name'] = $pickupman->name;
                            $temp['id'] = $employee_id;
                            $temp['message'] = $message;
                            $temp['selection'] = $request->selection;
                            $temp['exists'] = true;
                            array_push($salary_message, $temp);
                        } else {
                            $name = $pickupman->name;
                            $id = $pickupman->id;
                            $advance_salary = $pickupman->advanceSalary->sum('advance_amount');
                            $temp['name'] = $name;
                            $temp['id'] = $id;
                            $temp['selection'] = $request->selection;
                            $temp['advance_salary'] = $advance_salary;
                            $temp['comission'] = $comission;
                            $temp['absent_days'] = $absent_day_final;
                            $temp['fine'] = $amount;

                            $temp['gross_salary'] = $pickupman->gross_salary;
                            $temp['exists'] = false;

                            array_push($salary_message, $temp);
                        }
                    }
                }
                break;
        }

        // return $salary_message;

        return view('backend.pages.superadmin.accounts.salary.create', compact('employees_datas', 'Orginal_month', 'salary_year', 'salary_message'));
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
        $employee_id = $request->employee_id;
        $year = $request->year;
        $month = $request->month;
        $invoice_no = mt_rand(11111, 99999);
        // $exists = EmployeeSalary::where(['year' => $year, 'month' => $month, 'employee_id' => $employee_id])->exists();
        $invoice_no = mt_rand(111111, 999999);

        switch ($request->selection) {
            case '1':
                $length = count($request->total_paid);
                // return $length;

                for ($i = 0; $i < $length; $i++) {
                    if ($request->total_paid[$i] != null) {
                        $salary = new EmployeeSalary();
                        $salary->employee_id = $request->employee_id[$i];
                        $salary->year = $request->year;
                        $salary->boucher = $invoice_no;
                        $salary->month = $request->month;
                        $salary->comission = $request->comission[$i];
                        $salary->bonus = $request->bonus[$i];
                        $salary->deduction = $request->deduction[$i];
                        $salary->total_paid = $request->total_paid[$i];
                        // $salary->arrear = $request->arrear[$i];
                        $salary->remarks = $request->remarks[$i];
                        $salary->created_at = Carbon::now();
                        $salary->updated_at = Carbon::now();
                        $salary->save();

                        $advance_salary = EmployeeAdvanceSalary::where('employee_id', $request->employee_id[$i])->update([
                            'advance_amount' => 0,
                        ]);
                    }
                }

                $boucher_data = [
                    'invoice_no' => $invoice_no,
                    'year' => $request->year,
                    'month' => $request->month,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                EmployeeSalarInvoice::insert($boucher_data);
                // return $employee_salary_data;
                if ($boucher_data) {
                    return back()->with('success', 'Salray created successfully. Please pay the invoice No. #' . $invoice_no);
                }
                break;
            case '2':
                $length = count($request->total_paid);
                // return $length;

                for ($i = 0; $i < $length; $i++) {
                    if ($request->total_paid[$i] != null) {
                        $salary = new DeliveryManSalary();
                        $salary->deliveryman_id = $request->employee_id[$i];
                        $salary->year = $request->year;
                        $salary->boucher = $invoice_no;
                        $salary->month = $request->month;
                        $salary->comission = $request->comission[$i];
                        $salary->bonus = $request->bonus[$i];
                        $salary->deduction = $request->deduction[$i];
                        $salary->total_paid = $request->total_paid[$i];
                        // $salary->arrear = $request->arrear[$i];
                        $salary->remarks = $request->remarks[$i];
                        $salary->created_at = Carbon::now();
                        $salary->updated_at = Carbon::now();
                        $salary->save();

                        $advance_salary = DeliverymanAdvance::where('deliveryman_id', $request->employee_id[$i])->update([
                            'advance_amount' => 0,
                        ]);
                    }
                }

                $boucher_data = [
                    'invoice_no' => $invoice_no,
                    'year' => $request->year,
                    'month' => $request->month,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DeliverySalaryInvoice::insert($boucher_data);
                // return $employee_salary_data;
                if ($boucher_data) {
                    return back()->with('success', 'Salray created successfully. Please pay the invoice No. #' . $invoice_no);
                }
                break;
            case '3':
                $length = count($request->total_paid);
                // return $length;

                for ($i = 0; $i < $length; $i++) {
                    if ($request->total_paid[$i] != null) {
                        $salary = new PickupmanSalary();
                        $salary->pickupman_id = $request->employee_id[$i];
                        $salary->year = $request->year;
                        $salary->boucher = $invoice_no;
                        $salary->month = $request->month;
                        $salary->comission = $request->comission[$i];
                        $salary->bonus = $request->bonus[$i];
                        $salary->deduction = $request->deduction[$i];
                        $salary->total_paid = $request->total_paid[$i];
                        // $salary->arrear = $request->arrear[$i];
                        $salary->remarks = $request->remarks[$i];
                        $salary->created_at = Carbon::now();
                        $salary->updated_at = Carbon::now();
                        $salary->save();

                        $advance_salary = PickupmanAdvance::where('pickupman_id', $request->employee_id[$i])->update([
                            'advance_amount' => 0,
                        ]);
                    }
                }

                $boucher_data = [
                    'invoice_no' => $invoice_no,
                    'year' => $request->year,
                    'month' => $request->month,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                PickupmanSalaryInvoice::insert($boucher_data);
                // return $employee_salary_data;
                if ($boucher_data) {
                    return back()->with('success', 'Salray created successfully. Please pay the invoice No. #' . $invoice_no);
                }
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $selection)
    {
        $boucher_no = $id;
        switch ($selection) {
            case 1:
                $salary_data = EmployeeSalary::with('employeeDetails')->where('boucher', $boucher_no)->get();
                break;
            case 2:
                $salary_data = DeliveryManSalary::with('employeeDetails')->where('boucher', $boucher_no)->get();
                // return $salary_data;
                break;
            case 3:
                $salary_data = PickupmanSalary::with('employeeDetails')->where('boucher', $boucher_no)->get();
                break;
        }
        return view('backend.pages.superadmin.accounts.salary.show', compact('salary_data'));
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

    // pay the salary
    public function paid(Request $request)
    {

        switch ($request->selection_id) {
            case 1:
                $paid = EmployeeSalarInvoice::where('invoice_no', $request->invoice_id)->update([
                    'payment_method' => $request->payment_method,
                    'payment_date' => $request->payment_date,
                    'status' => 1,
                ]);
                break;
            case 2:
                $paid = DeliverySalaryInvoice::where('invoice_no', $request->invoice_id)->update([
                    'payment_method' => $request->payment_method,
                    'payment_date' => $request->payment_date,
                    'status' => 1,
                ]);
                break;
            case 3:
                $paid = PickupmanSalaryInvoice::where('invoice_no', $request->invoice_id)->update([
                    'payment_method' => $request->payment_method,
                    'payment_date' => $request->payment_date,
                    'status' => 1,
                ]);
                break;
        }

        return back()->with('success', 'Payment done successfully');
    }
}
