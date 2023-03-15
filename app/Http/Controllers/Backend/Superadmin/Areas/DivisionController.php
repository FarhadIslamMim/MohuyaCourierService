<?php

namespace App\Http\Controllers\Backend\Superadmin\Areas;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::select('id', 'name', 'created_at')->get();

        return view('backend.pages.superadmin.areas.division.division', compact('divisions'));
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
        //validate data
        $request->validate([
            'name' => 'required|unique:divisions',
        ]);

        $divisions = new Division();
        $divisions->name = $request->name;
        $divisions->save();

        if ($divisions) {
            return redirect()->back()->with('success', 'Division Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Unable to add division');
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
        //edit
        $division = Division::find($id)->first();

        return view('backend.pages.superadmin.areas.division.edit', compact('division'));
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
        //update data
        $request->validate([
            'name' => 'required|unique:divisions',
        ]);

        $update = Division::where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        if ($update) {
            return redirect()->route('division.index')->with('success', 'Division updated successfully');
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
        Division::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Division deleted Successfully');
    }
}
