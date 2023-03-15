<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use Illuminate\Http\Request;

class HubAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hubs = Hub::all();
        return view('backend.pages.superadmin.settings.hubareas.hubs', compact('hubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.superadmin.settings.hubareas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'subtitle'  => 'required',
            'status'     => 'required',
        ]);
        $hubs = new Hub();
        $hubs->title = $request->title;
        $hubs->subtitle = $request->subtitle;
        $hubs->text = $request->subtitle;
        $hubs->status = $request->status;
        $hubs->save();
        return back()->with('success', 'Hub added');
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
        $hubs = Hub::find($id);

        return view('backend.pages.superadmin.settings.hubareas.edit', compact('hubs'));
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
        $hubs = Hub::where('id', $request->id)->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'text' => $request->subtitle,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Hub successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $hubs = Hub::where('id', $id)->delete();

        return back()->with('success', 'Hub deleted successfully');
    }
}
