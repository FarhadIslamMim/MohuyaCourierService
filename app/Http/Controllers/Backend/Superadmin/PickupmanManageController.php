<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Pickupman;
use App\Models\PickupmanAgent;
use App\Models\PickupmanArea;
use App\Models\PickupmanEducation;
use App\Models\PickupmanExperience;
use App\Models\pickupmanPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use illuminate\support\str;

class PickupmanManageController extends Controller
{

    public function index()
    {
        //
        $show_datas = Pickupman::orderBy('id', 'DESC')->with('agents')
            ->get();
        // return $show_datas;
        return view('backend.pages.superadmin.pickupman.manage', compact('show_datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $agents = Agent::where('status', 1)->get();

        return view('backend.pages.superadmin.pickupman.create', compact('divisions', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'agent_id' => 'required',
            'name' => 'required',
            'email' => 'nullable|email|unique:pickupmen',
            'phone' => 'required|unique:pickupmen',
            'designation' => 'nullable',
            'per_parcel_amount' => 'required|numeric',
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
            $name = uniqid() . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/pickupman/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            return 'No image';
        }

        $store_data = new Pickupman();
        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->alternative_phone = $request->alternative_phone;
        $store_data->nid_no = $request->nid_no;
        $store_data->gross_salary = $request->gross_salary;
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

        $store_data->per_parcel_amount = $request->per_parcel_amount;
        $store_data->division_id = $request->division_id;
        $store_data->district_id = $request->district_id;
        // $store_data->thana_id 			= 	$request->thana_id;
        // $store_data->area_id 			= 	$request->area_id;
        $store_data->api_token = Str::random(50);
        $store_data->password = bcrypt(request('password'));
        $store_data->image = $fileUrl;
        $store_data->status = $request->status;
        $store_data->save();

        // Save Deliveryman Education
        if ($request->exam_name) {
            for ($i = 0; $i < sizeof($request->exam_name); $i++) {
                $pickupman_Educations = [
                    'pickupman_id' => $store_data->id,
                    'exam_name' => $request->exam_name[$i],
                    'group' => $request->group[$i],
                    'gpa' => $request->gpa[$i],
                    'year' => $request->year[$i],
                    'board' => $request->board[$i],
                ];
                PickupmanEducation::insert($pickupman_Educations);
            }
        }


        // Save pickupman Experience
        if ($request->company_name) {
            for ($i = 0; $i < sizeof($request->company_name); $i++) {
                $pickupman_experiences = [
                    'pickupman_id' => $store_data->id,
                    'company_name' => $request->company_name[$i],
                    'designation' => $request->designations[$i],
                    'start_date' => $request->start_date[$i] ? date('Y-m-d', strtotime($request->start_date[$i])) : null,
                    'end_date' => $request->end_date[$i] ? date('Y-m-d', strtotime($request->end_date[$i])) : null,
                ];
                PickupmanExperience::insert($pickupman_experiences);
            }
        }


        if ($request->area_id) {
            for ($i = 0; $i < sizeof($request->agent_id); $i++) {
                $pickupman_agent = [
                    'pickupman_id' => $store_data->id,
                    'agent_id' => $request->agent_id[$i],
                ];
                PickupmanAgent::insert($pickupman_agent);
            }
        }




        if ($request->area_id) {
            for ($i = 0; $i < sizeof($request->area_id); $i++) {

                $area = Area::find($request->area_id[$i]);
                if ($area) {
                    $area = [
                        'pickupman_id' => $store_data->id,
                        'thana_id' => $area->thana_id,
                        'area_id' => $request->area_id[$i],
                    ];
                }
                PickupmanArea::insert($area);
            }
        }


        // Save deliveryman Areas
        foreach ($request->area_id ?? [] as $i => $area_id) {
            $area = Area::find($area_id);
            if ($area) {
                $area = [
                    'pickupman_id' => $store_data->id,
                    'thana_id' => $area->thana_id,
                    'area_id' => $request->area_id[$i],
                ];
            }
            PickupmanArea::insert($area);
        }
        return back()->with('success', 'pickupman has successfully added');
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
        $pickupman = pickupman::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::select('id', 'name')->get();
        $agent_id = PickupmanAgent::where('pickupman_id', $id)->pluck('agent_id')->toArray();
        $area_id = PickupmanArea::where('pickupman_id', $id)->pluck('area_id')->toArray();

        return view('backend.pages.superadmin.pickupman.view', compact('pickupman', 'divisions', 'agent_id', 'area_id', 'districts'));
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
        $edit_data = pickupman::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::orderBy('name')->where('status', 1)->get();
        $agent_id = PickupmanAgent::where('pickupman_id', $id)->pluck('agent_id')->toArray();
        $area_id = PickupmanArea::where('pickupman_id', $id)->pluck('area_id')->toArray();

        return view('backend.pages.superadmin.pickupman.edit', compact('edit_data', 'divisions', 'districts', 'agent_id', 'area_id'));
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
            // 'email' => 'nullable|email|unique:pickupmans,email,' . $request->hidden_id,
            // 'phone' => 'required|unique:pickupmans,phone,' . $request->hidden_id,
            'designation' => 'nullable',
            'per_parcel_amount' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'image' => 'nullable|image',
            'password' => 'nullable|same:confirm',
            'confirm' => 'nullable',
            // 'status' => 'required',
        ]);

        $update_data = pickupman::find($request->hidden_id);
        // image upload
        $update_file = $request->file('image');
        if ($update_file) {
            $name = time() . $update_file->getClientOriginalName();
            $uploadPath = 'public/uploads/pickupman/';
            $update_file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_data->image;
        }

        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->alternative_phone = $request->alternative_phone;
        $update_data->nid_no = $request->nid_no;
        $update_data->gross_salary = $request->gross_salary;
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
        $update_data->per_parcel_amount = $request->per_parcel_amount;
        $update_data->division_id = $request->division_id;
        $update_data->district_id = $request->district_id;
        if (request('password')) {
            $update_data->password = bcrypt(request('password'));
        }

        $update_data->image = $fileUrl;
        $update_data->status = $request->status;
        $update_data->save();

        // update pickupman Education
        if ($request->exam_name && count($request->exam_name) > 0) {

            for ($i = 0; $i < sizeof($request->exam_name); $i++) {
                $educations = [
                    'pickupman_id' => $update_data->id,
                    'exam_name' => $request->exam_name[$i],
                    'group' => $request->group[$i],
                    'gpa' => $request->gpa[$i],
                    'year' => $request->year[$i],
                    'board' => $request->board[$i],
                ];

                PickupmanEducation::insert($educations);
            }
        }

        // Update Pickupman Experience
        PickupmanExperience::where('pickupman_id', $update_data->id)->delete();

        if ($request->company_name && count($request->company_name) > 0) {
            for ($i = 0; $i < sizeof($request->company_name); $i++) {
                $data = [
                    'pickupman_id' => $update_data->id,
                    'company_name' => $request->company_name[$i],
                    'designation' => $request->designations[$i] ?? '',
                    'start_date' => $request->start_date[$i] ? date('Y-m-d', strtotime($request->start_date[$i])) : null,
                    'end_date' => $request->end_date[$i] ? date('Y-m-d', strtotime($request->end_date[$i])) : null,
                ];

                PickupmanExperience::insert($data);
            }
        }
        // Update pickupman Agents
        PickupmanAgent::where('pickupman_id', $update_data->id)->whereNotIn('agent_id', $request->agent_id)->delete();

        for ($i = 0; $i < sizeof($request->agent_id); $i++) {
            $exist = PickupmanAgent::where('pickupman_id', $update_data->id)->where('agent_id', $request->agent_id[$i])->first();
            if ($exist) {
                $exist->update([
                    'pickupman_id' => $update_data->id,
                    'agent_id' => $request->agent_id[$i],
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                $agents = [
                    'pickupman_id' => $update_data->id,
                    'agent_id' => $request->agent_id[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                PickupmanAgent::insert($agents);
            }
        }

        // Update pickupman Areas
        PickupmanArea::where('pickupman_id', $update_data->id)->whereNotIn('area_id', $request->area_id)->delete();
        foreach ($request->area_id ?? [] as $key => $area_id) {
            $area = Area::find($area_id);
            if ($area) {
                $exist = PickupmanArea::where('pickupman_id', $update_data->id)->where('area_id', $area_id)->first();
                if ($exist) {
                    $exist->update([
                        'pickupman_id' => $update_data->id,
                        'thana_id' => $area->thana_id,
                        'area_id' => $area_id,
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    $areas = [
                        'pickupman_id' => $update_data->id,
                        'thana_id' => $area->thana_id,
                        'area_id' => $key,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                    PickupmanArea::insert($areas);
                }
            }
        }

        return redirect()->back()->with('success', 'pickupman updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pickupman_id = $id;
        pickupman::where('id', $id)->delete();
        PickupmanAgent::where('pickupman_id', $id)->delete();
        pickupmanPayment::where('pickupman_id', $id)->delete();
        PickupmanArea::where('pickupman_id', $id)->delete();
        PickupmanEducation::where('pickupman_id', $id)->delete();
        PickupmanExperience::where('pickupman_id', $id)->delete();

        return back()->with('success', 'pickupman Deleted successfully');
    }
}
