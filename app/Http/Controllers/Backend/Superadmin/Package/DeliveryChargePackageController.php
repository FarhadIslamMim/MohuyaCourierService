<?php

namespace App\Http\Controllers\Backend\Superadmin\Package;

use App\Http\Controllers\Controller;
use App\Models\DeliveryChargeHead;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Division;
use App\Models\PackageExcludedWeights;
use App\Models\Thana;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryChargePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $delivery_package = DeliveryPackage::select('*')->with('getDeliveryAreas', 'getDeliveryHead','getWeights','getDistricts')->get();
        // return $delivery_package;
        return view('backend.pages.superadmin.package.package', compact('delivery_package'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dlivery_charge_heads = DeliveryChargeHead::select('id', 'name')->get();
        $divisions = Division::select('id', 'name')->get();
        $weights = Weight::all();
        return view('backend.pages.superadmin.package.create', compact('divisions', 'dlivery_charge_heads', 'weights'));
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

        switch ($request->category) {
            case 1:
                $request->validate([
                    'package_name' => 'required',
                    'delivery_charge_head_id' => 'required',
                    'division_id' => 'required',
                    'district_id' => 'required',
                ]);

                $delivery_package = new DeliveryPackage();
                $delivery_package->package_name = $request->package_name;
                $delivery_package->delivery_charge_head = $request->delivery_charge_head_id;
                $delivery_package->division_id = $request->division_id;
                $delivery_package->district_id = $request->district_id;
                $delivery_package->delivery_charge = $request->delivery_charge;
                $delivery_package->extra_delivery_charge = $request->extra_delivery_charge;
                $delivery_package->cod_charge = $request->cod_charge;
                $delivery_package->return_charge = $request->return_charge;
                $delivery_package->save();

                if (count($request->thana_id) > 0) {
                    foreach ($request->thana_id ?? [] as $key => $value) {
                        $area_data[] = [
                            'delivery_package_id' => $delivery_package->id,
                            'delivery_thanas' => $request->thana_id[$key],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    DeliveryPackageArea::insert($area_data);
                }

                if ($request->excluded_weights) {
                    for ($i = 0; $i < sizeof($request->excluded_weights); $i++) {
                        $excluded_weights = [
                            'package_id'   => $delivery_package->id,
                            'weight_id'     => $request->excluded_weights[$i],
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];

                        PackageExcludedWeights::create($excluded_weights);
                    }
                }
                return back()->with('success', 'Delivery Package Added');
                break;
            case 2:
                $request->validate([
                    'package_name' => 'required',
                    'delivery_charge_head_id' => 'required',
                    'division_id' => 'required',
                    'district_id' => 'required',
                ]);

                $delivery_package = new DeliveryPackage();
                $delivery_package->package_name = $request->package_name;
                $delivery_package->delivery_charge_head = $request->delivery_charge_head_id;
                $delivery_package->division_id = $request->division_id;
                $delivery_package->district_id = $request->district_id;
                $delivery_package->delivery_charge = $request->delivery_charge;
                $delivery_package->extra_delivery_charge = $request->extra_delivery_charge;
                $delivery_package->cod_charge = $request->cod_charge;
                $delivery_package->return_charge = $request->return_charge;
                $delivery_package->save();

                if (count($request->thana_id) > 0) {
                    foreach ($request->thana_id ?? [] as $key => $value) {
                        $area_data[] = [
                            'delivery_package_id' => $delivery_package->id,
                            'delivery_thanas' => $request->thana_id[$key],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    DeliveryPackageArea::insert($area_data);
                }
                if ($request->excluded_weights) {
                    for ($i = 0; $i < sizeof($request->excluded_weights); $i++) {
                        $excluded_weights = [
                            'package_id'   => $delivery_package->id,
                            'weight_id'     => $request->excluded_weights[$i],
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];

                        PackageExcludedWeights::create($excluded_weights);
                    }
                }

                return back()->with('success', 'Delivery Package Added');
                break;
            case 3:
                $request->validate([
                    'package_name' => 'required',
                    'district_id' => 'required',
                ], [
                    'district_id.required' => "Please select District"
                ]);

                $delivery_package = new DeliveryPackage();
                $delivery_package->package_name = $request->package_name;
                $delivery_package->delivery_charge_head = $request->delivery_charge_head_id;
                $delivery_package->delivery_charge = $request->delivery_charge;
                $delivery_package->extra_delivery_charge = $request->extra_delivery_charge;
                $delivery_package->cod_charge = $request->cod_charge;
                $delivery_package->return_charge = $request->return_charge;
                $delivery_package->save();

                if (count($request->district_id) > 0) {
                    foreach ($request->district_id ?? [] as $key => $value) {
                        $area_data[] = [
                            'package_id' => $delivery_package->id,
                            'district_id' => $request->district_id[$key],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    DeliveryPacakageDistrict::insert($area_data);
                }

                if ($request->excluded_weights) {
                    for ($i = 0; $i < sizeof($request->excluded_weights); $i++) {
                        $excluded_weights = [
                            'package_id'   => $delivery_package->id,
                            'weight_id'     => $request->excluded_weights[$i],
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];

                        PackageExcludedWeights::create($excluded_weights);
                    }
                }
                return back()->with('success', 'Delivery Package Added');
                break;
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
        $divisions = Division::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $thanas = Thana::select('id', 'name')->get();
        $dlivery_charge_heads = DeliveryChargeHead::select('id', 'name')->get();
        $delivery_packages = DeliveryPackage::where('id', $id)->with('getDeliveryAreas')->first();
        // return $delivery_packages;
        return view('backend.pages.superadmin.package.edit', compact('divisions', 'districts', 'thanas', 'dlivery_charge_heads', 'delivery_packages'));
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
        $delivery_package = DeliveryPackage::where('id', $request->id)->update([
            'package_name' => $request->package_name,
            'delivery_charge_head' => $request->delivery_charge_head,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'delivery_charge' => $request->delivery_charge,
            'extra_delivery_charge' => $request->extra_delivery_charge,
            'cod_charge' => $request->cod_charge,
            'return_charge' => $request->return_charge,
        ]);

        $delete = DeliveryPackageArea::where('delivery_package_id', $request->id)->delete();
        if (count($request->thana_id) > 0) {
            foreach ($request->thana_id ?? [] as $key => $value) {
                $area_data[] = [
                    'delivery_package_id' => $request->id,
                    'delivery_thanas' => $request->thana_id[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            DeliveryPackageArea::insert($area_data);
        }

        return back()->with('success', 'Package has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DeliveryPackage::where('id', $id)->delete();
        DeliveryPackageArea::where('delivery_package_id', $id)->delete();

        return back()->with('success', 'Delivery Package is successfully deleted');
    }



    /**
     * Method locationSetup
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function locationSetup(Request $request)
    {
        $divisions = Division::select('id', 'name')->get();
        $districts = District::select('id', 'name')->whereNotIn('id', [1])->get();

        switch ($request->id) {
            case 1:
                $output = '
                <input type="text" value="1" hidden="" name="category" />
                
                <div id="inside_city">';
                $output .= '<div class="row gy-4">';
                $output .= ' <div class="form-group col-md-6">
                <label for="division_id">Division<span class="text-danger">*</span> </label>
                <select name="division_id" id="division_id" class="form-control select2" required>
                    <option value=""> Select Division </option>';

                foreach ($divisions as $division) {
                    $output .=  '<option value="' . $division->id . '">' . $division->name . '</option>';
                }

                $output .= '</select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="district_id">District<span class="text-danger">*</span> </label>
                        <select name="district_id" id="district_id" class="form-control select2" required>
                            <option value="">Select District </option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                        <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                            <option value="">Select Thana </option>
                        </select>
                    </div>
                </div>
            </div>';

                return $output;
                break;
            case 2:
                $output = '
                <input type="text" value="1" hidden="" name="category" />
                
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50">Action</th>
                        <th width="100">Division</th>
                        <th width="100">District</th>
                        <th width="120">Thana</th>
                    </tr>
                </thead>
                <tbody id="add-row-expense">
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a class="btn btn-primary btn-sm" onclick="addRowExpense();"
                                href="javascript:void(0)">Add Row</a>
                        </td>
                    </tr>
                </tfoot>
            </table>';
                return $output;
                break;
            case 3:
                $output = '
                <input type="text" value="3" hidden="" name="category" />
                <div id="inside_city">';
                $output .= '<div class="row gy-4">';
                $output .= ' <div class="form-group col-md-12   ">
                <label for="district_id_all">District<span class="text-danger">*</span> </label>
                <select multiple name="district_id[]" id="district_id_all" class="form-control select2 district_id_all" required>
                    <option value="">All</option>';

                foreach ($districts as $district) {
                    $output .=  '<option value="' . $district->id . '">' . $district->name . '</option>';
                }

                $output .= '</select>
                    </div>
                </div>
            </div>';

                return $output;
                break;
        }
    }
}
