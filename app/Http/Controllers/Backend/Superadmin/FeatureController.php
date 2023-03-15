<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $features = Feature::all();
        return view('backend.pages.superadmin.settings.features.features', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.superadmin.settings.features.create');
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
        $features = new Feature();
        $features->title = $request->title;
        $features->subtitle = $request->subtitle;
        $features->subtitle = $request->subtitle;
        if ($request->file('image')) {
            $features->image = $this->fileUpload($request->file('image'), 'public/uploads/features/');
        }
        $features->status = $request->status;
        $features->save();
        return back()->with('success', 'Feature added');
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
        $feature = Feature::find($id);

        return view('backend.pages.superadmin.settings.features.edit', compact('feature'));
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
        if ($request->has('image')) {
            $features = Feature::find($request)->first();

            // delete existing file
            $delete_file = File::delete($features->image);
            $image = $this->fileUpload($request->file('image'), 'public/uploads/features/');

            $feature = Feature::where('id', $request->id)->update([
                'heading_text' => $request->heading_text,
                'secondary_text' => $request->secondary_text,
                'name' => $request->name,
                'image' => $image,
                'status' => $request->status,
            ]);
        } else {
            $feature = Feature::where('id', $request->id)->update([
                'heading_text' => $request->heading_text,
                'secondary_text' => $request->secondary_text,
                'name' => $request->name,
                'status' => $request->status,
            ]);
        }


        return back()->with('success', 'Feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $features = Feature::where('id', $id)->get();
        foreach ($features as $feature) {
            $delete_file = File::delete($feature->image);
        }
        $feature->delete();

        return back()->with('success', 'Feature deleted successfully');
    }
}
