<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::all();
        return view('backend.pages.superadmin.settings.services.services', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.superadmin.settings.services.create');
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
            'text'  => 'required',
            'status'     => 'required',
        ]);
        $services = new Service();
        $services->title = $request->title;
        $services->text = $request->text;
        if ($request->file('image')) {
            $services->image = $this->fileUpload($request->file('image'), 'public/uploads/services/');
        }
        $services->status = $request->status;
        $services->save();
        return back()->with('success', 'Service added');
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
        $service = Service::find($id);

        return view('backend.pages.superadmin.settings.services.edit', compact('service'));
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
        $services = Service::find($request)->first();

        if ($request->has('image')) {
            // delete existing file
            $delete_file = File::delete($services->image);
            $image = $this->fileUpload($request->file('image'), 'public/uploads/services/');
            Service::where('id', $request->id)->update([
                'title' => $request->title,
                'text' => $request->text,
                'image' => $image,
                'status' => $request->status,
            ]);
        } else {
            Service::where('id', $request->id)->update([
                'title' => $request->title,
                'text' => $request->text,
                'status' => $request->status,
            ]);
        }


        return back()->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services = Service::where('id', $id)->get();
        foreach ($services as $service) {
            $delete_file = File::delete($service->image);
        }
        $service->delete();

        return back()->with('success', 'Service deleted successfully');
    }
}
