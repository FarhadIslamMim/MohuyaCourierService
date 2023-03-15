<?php

namespace App\Http\Controllers\Backend\Superadmin\Areas;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $delivery_charges = Deliverycharge::orderBy('id')->where('status', 1)->get();
        $thanas = Thana::with('division', 'district')->get();

        return view('backend.pages.superadmin.areas.thana.thana', compact('divisions', 'districts', 'thanas', 'delivery_charges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:thanas',
        ]);

        $thanas = new Thana();
        $thanas->division_id = $request->division_id;
        $thanas->district_id = $request->district_id;
        $thanas->deliverycharge_id = $request->deliverycharge_id;
        $thanas->name = $request->name;
        $thanas->status = 1;
        $thanas->save();

        return back()->with('success', 'Thana added successfully');
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
        $districts = District::orderBy('name')->where('status', 1)->get();
        $delivery_charges = Deliverycharge::orderBy('id')->where('status', 1)->get();
        $thanas = Thana::find($id);

        return view('backend.pages.superadmin.areas.thana.edit', compact('districts', 'divisions', 'thanas', 'delivery_charges'));
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
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => 'required|string|max:191',
            'deliverycharge_id' => 'required',
        ]);

        Thana::where('id', $request->id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'deliverycharge_id' => $request->deliverycharge_id,
            'name' => $request->name,
        ]);

        return redirect()->route('thana.index')->with('success', 'Thana Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete thana
        Thana::where('id', $id)->delete();

        return back()->with('success', 'Thana deleted successfully');
    }
}
