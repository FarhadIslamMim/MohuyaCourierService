<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\EmployeeAgent;
use App\Models\EmployeeArea;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use illuminate\support\str;

class EmployeeManageController extends Controller
{
    public function index()
    {
        $show_datas = Employee::orderBy('id', 'DESC')->get();
        return view('backend.pages.superadmin.employees.manage', compact('show_datas'));
    }

    public function create()
    {
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $agents = Agent::where('status', 1)->get();
        return view('backend.pages.superadmin.employees.create', compact('divisions', 'agents'));
    }

    public function store(Request $request)
    {
         dd($request->all());

        $this->validate($request, [
            'agent_id' => 'required',
            'name' => 'required',
            'email' => 'nullable|email|unique:employees',
            'phone' => 'required|unique:employees',
            'designation' => 'nullable',
            'gross_salary' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'image' => 'required',
            'password' => 'required|same:confirm',
            'confirm' => 'required',
            'status' => 'required',
        ]);
        // image upload

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = uniqid().$file->getClientOriginalName();
            $uploadPath = 'uploads/employee/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath.$name;
        } else {
            return 'No image';
        }

        $store_data = new Employee();
        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->alternative_phone = $request->alternative_phone;
        $store_data->nid_no = $request->nid_no;
        $store_data->designation = $request->designation;
        $store_data->fathers_name = $request->fathers_name;
        $store_data->fathers_profession = $request->fathers_profession;
        $store_data->fathers_nid_no = $request->fathers_nid_no;
        $store_data->fathers_mobile_no = $request->fathers_mobile_no;
        $store_data->mothers_name = $request->mothers_name;
        $store_data->mothers_profession = $request->mothers_profession;
        $store_data->mothers_nid_no = $request->mothers_nid_no;
        $store_data->mothers_mobile_no = $request->mothers_mobile_no;
        $store_data->birth_date = $request->birth_date;
        $store_data->religion = $request->religion;
        $store_data->marital_status = $request->marital_status;
        $store_data->present_address = $request->present_address;
        $store_data->permanent_address = $request->permanent_address;
        $store_data->guaranteer_information = $request->guaranteer_information;
        $store_data->guaranteer_name = $request->guaranteer_name;
        $store_data->fathers_name = $request->fathers_name;
        $store_data->guaranteer_relation = $request->guaranteer_relation;
        $store_data->guaranteer_nid_no = $request->guaranteer_nid_no;
        $store_data->guaranteer_mobile_no = $request->guaranteer_mobile_no;
        $store_data->guaranteer_present_address = $request->guaranteer_present_address;
        $store_data->guaranteer_permanent_address = $request->guaranteer_permanent_address;

        $store_data->gross_salary = $request->gross_salary;
        $store_data->division_id = $request->division_id;
        $store_data->district_id = $request->district_id;
        // $store_data->thana_id 			= 	$request->thana_id;
        // $store_data->area_id 			= 	$request->area_id;
        $store_data->api_token = Str::random(50);
        $store_data->password = bcrypt(request('password'));
        $store_data->image = $fileUrl;
        $store_data->status = $request->status;
        $store_data->save();

        // Saveemployee Education
        foreach ($request->exam_name ?? [] as $i => $exam_name) {
            EmployeeEducation::create([
                'employee_id' => $store_data->id,
                'exam_name' => $exam_name,
                'group' => $request->group[$i] ?? '',
                'gpa' => $request->gpa[$i] ?? '',
                'year' => $request->year[$i] ?? '',
                'board' => $request->board[$i] ?? '',
            ]);
        }

        // Saveemployee Experience
        foreach ($request->company_name ?? [] as $i => $company_name) {
            EmployeeExperience::create([
                'employee_id' => $store_data->id,
                'company_name' => $company_name,
                'designation' => $request->designations[$i] ?? '',
                'start_date' => $request->start_date[$i] ? date('Y-m-d', strtotime($request->start_date[$i])) : null,
                'end_date' => $request->end_date[$i] ? date('Y-m-d', strtotime($request->end_date[$i])) : null,
            ]);
        }

        // Saveemployee Agents
        foreach ($request->agent_id ?? [] as $agent_id) {
            EmployeeAgent::create([
                'employee_id' => $store_data->id,
                'agent_id' => $request->agent_id,
            ]);
        }

        // Saveemployee Areas
        foreach ($request->area_id ?? [] as $area_id) {
            $area = Area::find($area_id);
            if ($area) {
                EmployeeArea::create([
                    'employee_id' => $store_data->id,
                    'thana_id' => $area->thana_id,
                    'area_id' => $request->area_id,
                ]);
            }
        }

        return back()->with('success', 'Employee has successfully added');
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
        $employee = employee::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $agent_id = employeeAgent::where('employee_id', $id)->pluck('agent_id')->toArray();
        $area_id = employeeArea::where('employee_id', $id)->pluck('area_id')->toArray();

        return view('backend.pages.superadmin.employees.view', compact('employee', 'divisions', 'agent_id', 'area_id'));
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
        $edit_data = Employee::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::orderBy('name')->where('status', 1)->get();
        $agent_id = EmployeeAgent::where('employee_id', $id)->pluck('agent_id')->toArray();
        $area_id = EmployeeArea::where('employee_id', $id)->pluck('area_id')->toArray();

        return view('backend.pages.superadmin.employees.edit', compact('edit_data', 'divisions', 'districts', 'agent_id', 'area_id'));
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
        // dd($request->all());

        $this->validate($request, [
            'hidden_id' => 'required',
            'agent_id' => 'required|array',
            'area_id' => 'required|array',
            'name' => 'required',
            'email' => 'nullable|email|unique:employees,email,'.$request->hidden_id,
            'phone' => 'required|unique:employees,phone,'.$request->hidden_id,
            'designation' => 'nullable',
            'gross_salary' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'image' => 'nullable|image',
            'password' => 'nullable|same:confirm',
            'confirm' => 'nullable',
            // 'status' => 'required',
        ]);

        $update_data = Employee::find($request->hidden_id);
        // image upload
        $update_file = $request->file('image');
        if ($update_file) {
            $name = time().$update_file->getClientOriginalName();
            $uploadPath = 'public/uploads/employee/';
            $update_file->move($uploadPath, $name);
            $fileUrl = $uploadPath.$name;
        } else {
            $fileUrl = $update_data->image;
        }

        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->alternative_phone = $request->alternative_phone;
        $update_data->nid_no = $request->nid_no;
        $update_data->designation = $request->designation;
        $update_data->fathers_name = $request->fathers_name;
        $update_data->fathers_profession = $request->fathers_profession;
        $update_data->fathers_nid_no = $request->fathers_nid_no;
        $update_data->fathers_mobile_no = $request->fathers_mobile_no;
        $update_data->mothers_name = $request->mothers_name;
        $update_data->mothers_profession = $request->mothers_profession;
        $update_data->mothers_nid_no = $request->mothers_nid_no;
        $update_data->mothers_mobile_no = $request->mothers_mobile_no;
        $update_data->birth_date = $request->birth_date;
        $update_data->religion = $request->religion;
        $update_data->marital_status = $request->marital_status;
        $update_data->present_address = $request->present_address;
        $update_data->permanent_address = $request->permanent_address;
        $update_data->guaranteer_information = $request->guaranteer_information;
        $update_data->guaranteer_name = $request->guaranteer_name;
        $update_data->fathers_name = $request->fathers_name;
        $update_data->guaranteer_relation = $request->guaranteer_relation;
        $update_data->guaranteer_nid_no = $request->guaranteer_nid_no;
        $update_data->guaranteer_mobile_no = $request->guaranteer_mobile_no;
        $update_data->guaranteer_present_address = $request->guaranteer_present_address;
        $update_data->guaranteer_permanent_address = $request->guaranteer_permanent_address;
        $update_data->gross_salary = $request->gross_salary;
        $update_data->division_id = $request->division_id;
        $update_data->district_id = $request->district_id;
        if (request('password')) {
            $update_data->password = bcrypt(request('password'));
        }

        $update_data->image = $fileUrl;
        $update_data->status = $request->status;
        $update_data->save();

        // Ypdateemployee Education
        employeeEducation::where('employee_id', $update_data->id)->delete();
        if ($request->exam_name && count($request->exam_name) > 0) {
            foreach ($request->exam_name ?? [] as $i => $exam_name) {
                $educations = [
                    'employee_id' => $update_data->id,
                    'exam_name' => $exam_name,
                    'group' => $request->group[$i] ?? '',
                    'gpa' => $request->gpa[$i] ?? '',
                    'year' => $request->year[$i] ?? '',
                    'board' => $request->board[$i] ?? '',
                ];
            }

            employeeEducation::insert($educations);
        }

        // Updateemployee Experience
        employeeExperience::where('employee_id', $update_data->id)->delete();
        if ($request->company_name && count($request->company_name) > 0) {
            foreach ($request->company_name ?? [] as $j => $company_name) {
                employeeExperience::create([
                    'employee_id' => $update_data->id,
                    'company_name' => $company_name,
                    'designation' => $request->designations[$j] ?? '',
                    'start_date' => $request->start_date[$j] ? date('Y-m-d', strtotime($request->start_date[$j])) : null,
                    'end_date' => $request->end_date[$j] ? date('Y-m-d', strtotime($request->end_date[$j])) : null,
                ]);
            }
        }

        // Updateemployee Agents
        employeeAgent::where('employee_id', $update_data->id)->whereNotIn('agent_id', $request->agent_id)->delete();
        foreach ($request->agent_id ?? [] as $key => $agent_id) {
            $exist = employeeAgent::where('employee_id', $update_data->id)->where('agent_id', $agent_id)->first();
            if ($exist) {
                $exist->update([
                    'employee_id' => $update_data->id,
                    'agent_id' => $key,
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                $agents = [
                    'employee_id' => $update_data->id,
                    'agent_id' => $key,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                employeeAgent::insert($agents);
            }
        }

        // Updateemployee Areas
        employeeArea::where('employee_id', $update_data->id)->whereNotIn('area_id', $request->area_id)->delete();
        // dd($request->area_id);
        foreach ($request->area_id ?? [] as $key => $area_id) {
            $area = Area::find($area_id);
            if ($area) {
                $exist = employeeArea::where('employee_id', $update_data->id)->where('area_id', $area_id)->first();
                if ($exist) {
                    $exist->update([
                        'employee_id' => $update_data->id,
                        'thana_id' => $area->thana_id,
                        'area_id' => $area_id,
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    $areas = [
                        'employee_id' => $update_data->id,
                        'thana_id' => $area->thana_id,
                        'area_id' => $key,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                EmployeeArea::insert($areas);
            }
        }

        return redirect()->back()->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        $employee_id = $id;
        Employee::where('id', $id)->delete();
        EmployeeAgent::where('employee_id', $id)->delete();
        EmployeeArea::where('employee_id', $id)->delete();
        EmployeeEducation::where('employee_id', $id)->delete();
        EmployeeExperience::where('employee_id', $id)->delete();

        return back()->with('success', 'employee Deleted successfully');
    }
}
