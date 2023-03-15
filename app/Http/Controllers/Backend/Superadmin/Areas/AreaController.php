<?php

namespace App\Http\Controllers\Backend\Superadmin\Areas;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Area::select('*')->with('division', 'district', 'thana');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('area.edit', $row->id).'" class="btn rounded-pill btn-success waves-effect waves-light"><i class=" bx bx-edit-alt"></i> Edit</a>';
                    $btn .= '<a href="'.route('area.delete', $row->id).'" class="btn rounded-pill btn-primary waves-effect waves-light"><i class="bx bx-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.pages.superadmin.areas.area.areas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $divisions = Division::select('id', 'name')->get();

        return view('backend.pages.superadmin.areas.area.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'name' => 'required|string|max:191',
            // 'coverage' => 'required',
            // 'delivery_type' => 'required',
            // 'pickup' => 'required',
            'status' => 'required',
        ]);

        $thana = Thana::find($request->thana_id);

        $store_data = new Area();
        $store_data->name = $request->name;
        $store_data->division_id = $thana->division_id;
        $store_data->district_id = $thana->district_id;
        $store_data->thana_id = $request->thana_id;
        // $store_data->deliverymen_id = $request->deliverymen_id;
        // $store_data->pickupman_id = $request->pickupman_id;
        // $store_data->coverage = $request->coverage;
        // $store_data->delivery_type = $request->delivery_type;
        // $store_data->pickup = $request->pickup;
        $store_data->status = $request->status;
        $store_data->save();

        return back()->with('success', 'Area added successfully');
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
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $edit_data = Area::find($id);
        $districts = District::orderBy('name')->where('status', 1)->get();
        $thanas = Thana::orderBy('name')->where('status', 1)->get();

        return view('backend.pages.superadmin.areas.area.edit', compact('divisions', 'districts', 'thanas', 'edit_data'));
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
        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'name' => 'required|string|max:191',
            // 'coverage' => 'required',
            // 'delivery_type' => 'required',
            // 'pickup' => 'required',
            'status' => 'required',
        ]);

        $thana = Thana::find($request->thana_id);
        $update_data = Area::find($request->hidden_id);
        $update_data->division_id = $thana->division_id;
        $update_data->district_id = $thana->district_id;
        $update_data->thana_id = $request->thana_id;
        // $update_data->deliverymen_id = $request->deliverymen_id;
        // $update_data->pickupman_id = $request->pickupman_id;
        $update_data->name = $request->name;
        // $update_data->coverage = $request->coverage;
        // $update_data->delivery_type = $request->delivery_type;
        // $update_data->pickup = $request->pickup;
        $update_data->status = $request->status;
        $update_data->save();

        return redirect()->back()->with('success', 'Area updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Area::where('id', $id)->delete();

        return back()->with('success', 'Area Deleted successfully');
    }
}
