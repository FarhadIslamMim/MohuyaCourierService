<?php

namespace App\Http\Controllers\Backend\Superadmin\Areas;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::select('id', 'name')->get();
        $districts = District::with('division')->get();
        // return $districts;
        return view('backend.pages.superadmin.areas.district.district', compact('districts', 'divisions'));
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
        // store data
        $request->validate([
            'division_id' => 'required',
            'name' => 'required|unique:districts',
        ]);

        $district = new District();
        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->status = 1;
        $district->save();

        return redirect()->back()->with('success', 'District added successfully');
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
        $districts = District::find($id);

        return view('backend.pages.superadmin.areas.district.edit', compact('districts', 'divisions'));
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
        //update
        District::where('id', $request->id)->update([
            'division_id' => $request->division_id,
            'name' => $request->name,
        ]);

        return redirect()->route('district.index')->with('success', 'District updated successfully');
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
        District::where('id', $id)->delete();

        return back()->with('success', 'District deleted successfully');
    }
}
