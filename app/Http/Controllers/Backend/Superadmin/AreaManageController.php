<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DeliveryChargeHead;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaManageController extends Controller
{
    //import areas
    public function importAreas(Request $request)
    {
        $delivery_charge_heads = DeliveryChargeHead::all();
        return view('backend.pages.superadmin.areas.import_areas', compact('delivery_charge_heads'));
    }

    // import areas data
    public function importAreasStore(Request $request)
    {

        // return $request->all();
        // validate the file
        $validator = Validator::make($request->all(), [
            'areas_csv' => 'required|file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please upload a file');
        }



        // convert the csv to an array.
        $file = fopen($request->areas_csv->getRealPath(), 'r');
        $file = $request->file('areas_csv');
        $csv_data = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csv_data));
        $header = array_shift($rows);

        // run the loop for validation and inserting datas
        foreach ($rows as $row) {
            if (count($header) == count($row)) {
                // combine the header and row of the csv file
                $areas_data = array_combine($header, $row);
                // prepare the areas data
                $division_name = $areas_data['division_name'];
                $district_name = $areas_data['district_name'];
                $thanas_name = $areas_data['thana_name'];
                $areas_name = $areas_data['thana_name'];

                // check division data
                if (Division::where('name', $division_name)->exists() == false) {
                    $division_data = Division::create([
                        'name' => $areas_data['division_name'],
                        'status' => 1,
                    ]);
                }

                // check district data
                if (District::where('name', $district_name)->exists() == false) {
                    $division_ids = Division::select('id')->where('name', $division_name)->get();

                    $districts = new District();
                    $districts->name = $areas_data['district_name'];
                    $districts->division_id = $division_ids[0]->id;
                    $districts->status = 1;
                    $districts->save();

                    // return $districts;
                }

                // check thana data
                if (Thana::where('name', $thanas_name)->exists() == false) {
                    $division_ids = Division::select('id')->where('name', $division_name)->get();
                    $district_ids = District::select('id')->where('name', $district_name)->get();

                    // return $district_ids[0]->id;
                    $thana = new Thana();
                    $thana->name = $areas_data['thana_name'];
                    $thana->division_id = $division_ids[0]->id;
                    $thana->district_id = $district_ids[0]->id;
                    $thana->deliverycharge_id = $request->delivery_charge_head;
                    $thana->status = 1;
                    $thana->save();
                }

                // check area data
                if (Area::where('name', $areas_name)->exists() == false) {
                    $division_ids = Division::select('id')->where('name', $division_name)->get();
                    $district_ids = District::select('id')->where('name', $district_name)->get();
                    $thana_ids = Thana::select('id')->where('name', $thanas_name)->get();

                    $area = new Area();
                    $area->name = $areas_data['area_name'];
                    $area->division_id = $division_ids[0]->id;
                    $area->district_id = $district_ids[0]->id;
                    $area->thana_id = $thana_ids[0]->id;
                    $area->status = 1;
                    $area->save();
                }
            }
        }

        return back()->with('success', 'Areas Imported Successfully');
    }
}
