<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use App\Models\DeliveryChargeHead;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_data = Deliverycharge::orderBy('id', 'DESC')->get();

        return view('backend.pages.superadmin.deliverycharge.deliverycharge', compact('show_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $delivery_charge_heads = DeliveryChargeHead::all();
        return view('backend.pages.superadmin.deliverycharge.create', compact('delivery_charge_heads'));
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
            'deliverycharge' => 'required',
            'extradeliverycharge' => 'required',
            'cod_charge' => 'required',
            'status' => 'required'
        ]);
        $insert_data = new Deliverycharge();
        $insert_data->delivery_charge_head_id = $request->delivery_charge_head_id;
        $insert_data->cod_charge = $request->cod_charge;
        $insert_data->deliverycharge = $request->deliverycharge;
        $insert_data->extradeliverycharge = $request->extradeliverycharge ?? 0;
        $insert_data->description = $request->description;
        $insert_data->return_charge = $request->return_charge;
        $insert_data->status = $request->status;
        $insert_data->save();

        return back()->with('success', 'Delivery Charge added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = Deliverycharge::find($id);
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();

        return view('backend.pages.superadmin.deliverycharge.edit', compact('edit_data', 'delivery_charge_heads'));
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
            'delivery_charge_head_id' => 'required',
            'deliverycharge' => 'required|numeric',
            'extradeliverycharge' => 'required|numeric',
            'cod_charge' => 'required|numeric',
            'status' => 'required',
        ]);

        $update_data = Deliverycharge::find($request->hidden_id);
        $update_data->delivery_charge_head_id = $request->delivery_charge_head_id;
        $update_data->cod_charge = $request->cod_charge;
        $update_data->deliverycharge = $request->deliverycharge;
        $update_data->extradeliverycharge = $request->extradeliverycharge ?? 0;
        $update_data->description = $request->description;
        $update_data->return_charge = $request->return_charge;
        $update_data->status = $request->status;
        $update_data->save();

        return back()->with('success', 'Delivery Charge Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Deliverycharge::find($id)->delete();
        return back()->with('Delivery Charge Deleted Successfully');
    }
}
