<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentThana;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use illuminate\support\str;

class AgentManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $show_datas = Agent::orderBy('name')->get();

        return view('backend.pages.superadmin.agents.manage', compact('show_datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::orderBy('name')->where('status', 1)->get();

        return view('backend.pages.superadmin.agents.create', compact('divisions'));
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|email|unique:agents',
            'phone' => 'required|numeric|digits:11|unique:agents',
            // 'designation' => 'nullable',
            // 'division_id' => 'required',
            // 'district_id' => 'required',
            // 'thana_id' => 'required',
            //'image' => 'required|image',
            'password' => 'required|same:confirm',
            'confirm' => 'required',
            'status' => 'required',
        ]);

        // image upload
        //$file = $request->file('image');
        //$name = time() . $file->getClientOriginalName();
       // $uploadPath = 'public/uploads/agent/';
       // $file->move($uploadPath, $name);
       // $fileUrl = $uploadPath . $name;

        $store_data = new Agent();
        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->alternative_phone = $request->alternative_phone;
        $store_data->nid_no = $request->nid_no;
        $store_data->per_percel_amount = $request->per_percel_amount;
        // $store_data->designation = $request->designation;
        // $store_data->division_id = $request->division_id;
        // $store_data->district_id = $request->district_id;
        // $store_data->area_id = $request->area_id;
        $store_data->address = $request->address;
        $store_data->api_token = Str::random(50);
        $store_data->password = bcrypt(request('password'));
        //$store_data->image = $fileUrl;
        $store_data->status = $request->status;
        $store_data->save();


        // for ($i = 0; $i < sizeof($request->thana_id); $i++) {

        //     $thana = Thana::find($request->thana_id[$i]);
        //     $agent_thanas[] = [
        //         'agent_id' => $store_data->id,
        //         'district_id' => $thana->district_id,
        //         'thana_id' => $request->thana_id[$i],
        //     ];
        //     AgentThana::insert($agent_thanas);
        // }

        return redirect()->back()->with('success', 'Agent Added Successfully');
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
        $edit_data = Agent::find($id);

        $thana_ids = AgentThana::where('agent_id', $id)->pluck('thana_id')->toArray();
        // return $thana_ids;

        $divisions = Division::orderBy('name')->where('status', 1)->get();
        return view('backend.pages.superadmin.agents.edit', compact('edit_data', 'divisions', 'thana_ids'));
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
        // return $request->all();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|email|unique:agents,email,' . $request->hidden_id,
            'phone' => 'required|numeric|digits:11|unique:agents,phone,' . $request->hidden_id,
            // 'designation' => 'nullable',
            // 'division_id' => 'required',
            // 'district_id' => 'required',
            // 'thana_id'=>'required',
            //'image' => 'nullable|image',
            'status' => 'required',
        ]);
        $update_data = Agent::find($request->hidden_id);
        // image upload
        //$update_file = $request->file('image');
        // if ($update_file) {
        //     $name = time() . $update_file->getClientOriginalName();
        //     $uploadPath = 'public/uploads/agent/';
        //     $update_file->move($uploadPath, $name);
        //     $fileUrl = $uploadPath . $name;
        // } else {
        //     $fileUrl = $update_data->image;
        // }

        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->alternative_phone = $request->alternative_phone;
        $update_data->nid_no = $request->nid_no;
        $update_data->per_percel_amount = $request->per_percel_amount;
        // $update_data->designation = $request->designation;
        // $update_data->division_id = $request->division_id;
        // $update_data->district_id = $request->district_id;
        // $update_data->thana_id 			= 	$request->thana_id;
        //$update_data->area_id = $request->area_id;
        $update_data->address = $request->address;
        //$update_data->image = $fileUrl;
        if ($request->password) {
            $update_data->password = bcrypt(request('password'));
        }
        if (empty($update_data->api_token)) {
            $update_data->api_token = Str::random(50);
        }
        $update_data->status = $request->status;
        $update_data->save();

        // Remove prev agent thana
       // AgentThana::where('agent_id', $update_data->id)->whereNotIn('thana_id', $request->thana_id)->delete();

        // for ($i = 0; $i < sizeof($request->thana_id); $i++) {

        //     $exist = AgentThana::where('agent_id', $update_data->id)->where('thana_id', $request->thana_id[$i])->first();
        //     // return $exist;

        //     $thana = Thana::find($request->thana_id[$i]);
        //     if (empty($exist)) {
        //         $thana_data = [
        //             'agent_id' => $update_data->id,
        //             'district_id' => $thana->district_id,
        //             'thana_id' => $request->thana_id[$i],
        //         ];
        //         AgentThana::insert($thana_data);
        //     } else {
        //         $exist->update([
        //             'agent_id' => $update_data->id,
        //             'district_id' => $thana->district_id,
        //             'thana_id' => $request->thana_id[$i],
        //         ]);
        //     }
        // }
        return redirect()->back()->with('Agent Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agent::where('id', $id)->delete();
        AgentThana::where('agent_id', $id)->delete();

        return back()->with('success', 'Agent Deleted successfully');
    }
}
