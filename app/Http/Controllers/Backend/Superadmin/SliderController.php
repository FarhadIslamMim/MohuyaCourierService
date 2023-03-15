<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('backend.pages.superadmin.settings.sliders.sliders', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.superadmin.settings.sliders.create');
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
            'image' => 'required',
            'name' => 'required',
            // 'sort' => 'required',
            'status' => 'required',
        ]);

        $store_data = new Slider();
        $store_data->name = $request->name;
        $store_data->heading_text = $request->heading_text;
        $store_data->secondary_text = $request->secondary_text;
        $store_data->sort = 1;
        if ($request->file('image')) {
            $store_data->image = $this->fileUpload($request->file('image'), 'public/uploads/slider/');
        }
        $store_data->status = $request->status;
        $store_data->save();

        return redirect()->back()->with('success', 'Slider added successfully');
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
        //
        $slider = Slider::find($id);

        return view('backend.pages.superadmin.settings.sliders.edit', compact('slider'));
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
        //

        $sliders = Slider::find($request)->first();

        if ($request->has('image')) {
            $delete_file = File::delete($sliders->image);
            $image = $this->fileUpload($request->file('image'), 'public/uploads/slider/');

            $slider = Slider::where('id', $request->id)->update([
                'heading_text' => $request->heading_text,
                'secondary_text' => $request->secondary_text,
                'image' => $image,
                'name' => $request->name,
                'status' => $request->status,
            ]);
        } else {

            $slider = Slider::where('id', $request->id)->update([
                'heading_text' => $request->heading_text,
                'secondary_text' => $request->secondary_text,
                'name' => $request->name,
                'status' => $request->status,
            ]);
        }



        return back()->with('success', 'Slider updated successfully');
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
        $sliders = Slider::where('id', $id)->get();
        foreach ($sliders as $slider) {
            $delete_file = File::delete($slider->image);
        }
        $slider->delete();

        return back()->with('success', 'Slider deleted successfully');
    }
}
