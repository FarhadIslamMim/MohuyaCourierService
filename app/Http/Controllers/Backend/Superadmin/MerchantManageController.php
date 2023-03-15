<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPackage;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\MerchantExcludedWeights;
use App\Models\Nearestzone;
use App\Models\Thana;
use App\Models\User;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use illuminate\support\str;

class MerchantManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::where('status',1)->verify()->orderBy('firstName')->get();

        return view('backend.pages.superadmin.merchants.merchants', compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::where('status', 1)->get();
        $thanas = Thana::where('status', 1)->with('district')->get();

        return view('backend.pages.superadmin.merchants.create', compact('divisions', 'thanas'));
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
            'companyName' => 'required',
            'logo' => 'nullable|image',
            'phoneNumber' => 'required|numeric|digits:11|unique:merchants',
            'emailAddress' => 'nullable|unique:merchants',
            //'pickup_thana_id' => 'required',
            //'pickLocation' => 'required',
            //'identification_type' => 'required|numeric',
            //'nidnumber' => 'required_if:identification_type,=,1',
            // 'nid_photo' => 'image|required_if:identification_type,=,1',
            // 'nid_photo_back' => 'image|required_if:identification_type,=,1',
            //'birth_certificate_no' => 'required_if:identification_type,=,2',
            // 'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
            //'driving_licence_no' => 'required_if:identification_type,=,3',
            // 'driving_licence_photo' => 'image|required_if:identification_type,=,3',
            //'division_id' => 'required',
            //'district_id' => 'required',
            'password' => 'required|same:confirmed',
            'confirmed' => 'required',
        ]);

        $store_data = new Merchant();
        if ($request->file('logo')) {
            $store_data->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }

        $store_data->identification_type = $request->identification_type;
        if ($request->identification_type == 1) {
            $store_data->nidnumber = $request->nidnumber;
            if ($request->file('nid_photo')) {
                $store_data->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
            if ($request->file('nid_photo_back')) {
                $store_data->nid_photo_back = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 2) {
            $store_data->birth_certificate_no = $request->birth_certificate_no;
            if ($request->file('birth_certificate_photo')) {
                $store_data->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 3) {
            $store_data->driving_licence_no = $request->driving_licence_no;
            if ($request->file('driving_licence_photo')) {
                $store_data->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
            }
        }

        $store_data->companyName = $request->companyName;
        $store_data->firstName = $request->firstName;
        $store_data->phoneNumber = $request->phoneNumber;
        $store_data->emailAddress = $request->emailAddress;
        $store_data->username = $request->username;
        $store_data->fathers_name = $request->fathers_name;
        $store_data->mothers_name = $request->mothers_name;
        $store_data->trade_licence_no = $request->trade_licence_no;
        $store_data->pickup_thana_id = $request->pickup_thana_id;
        $store_data->pickLocation = $request->pickLocation;
        $store_data->website = $request->website;
        $store_data->facebook_page = $request->facebook_page;
        $store_data->nidnumber = $request->nidnumber;
        $store_data->division_id = $request->division_id;
        $store_data->district_id = $request->district_id;
        $store_data->thana_id = $request->thana_id;
        $store_data->area_id = $request->area_id;
        $store_data->present_address = $request->present_address;
        $store_data->permanent_address = $request->permanent_address;
        $store_data->payoption = $request->paymentMethod;
        $store_data->paymentMethod = $request->paymentMethod;
        $store_data->socialLink = $request->socialLink;

        if ($request->paymentMethod == 1) {
            $store_data->nameOfBank = $request->bank_name;
            $store_data->bankBranch = $request->branch_name;
            $store_data->bankAcHolder = $request->ac_holder_name;
            $store_data->bankAcNo = $request->bank_ac_no;
        } elseif ($request->paymentMethod == 2) {
            $store_data->bkashNumber = $request->bkashNumber;
        } elseif ($request->paymentMethod == 3) {
            $store_data->nogodNumber = $request->nogodNumber;
        }
        //   else if($request->paymentMethod == 1) {
        //       $store_data->bkashNumber = $request->paymentmode;
        //   }

        $store_data->agree = 1;
        $store_data->password = bcrypt(request('password'));
        $store_data->verify = 1;
        $store_data->status = 1;
        $store_data->api_token = Str::random(50);
        $store_data->save();

        if ($store_data) {
            return back()->with('success', 'Merchant added successfully');
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
        $merchantInfo = Merchant::find($id);
        // return $merchantInfo;
        $nearestzones = Nearestzone::where('status', 1)->get();
        $acqs = User::where('designation', 'Admin')->get();
        $role = Auth::user()->id;
        $divisions = Division::where('status', 1)->get();
        $districts = District::where('status', 1)->get();
        $thanas = Thana::where('status', 1)->with('district')->get();
        $inside_city = DeliveryPackage::where('delivery_charge_head', 1)->get();
        $sub_city = DeliveryPackage::where('delivery_charge_head', 2)->get();
        $outside_city = DeliveryPackage::where('delivery_charge_head', 3)->get();


        // return $excluded_weights;
        return view('backend.pages.superadmin.merchants.edit', compact('merchantInfo', 'divisions', 'districts', 'thanas', 'acqs', 'role', 'inside_city', 'sub_city', 'outside_city'));
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

        $rules = [];
        $rules['firstName'] = 'required';
        $rules['companyName'] = 'required';
        $rules['logo'] = 'nullable|image';
        //$rules['pickup_thana_id'] = 'required';
       // $rules['pickLocation'] = 'required';
       // $rules['identification_type'] = 'required';
        // $rules['nidnumber'] = "required_if:identification_type,=,1";
        $rules['birth_certificate_no'] = 'required_if:identification_type,=,2';
        $rules['driving_licence_no'] = 'required_if:identification_type,=,3';
        $rules['division_id'] = 'required';
        $rules['district_id'] = 'required';

        $update_merchant = Merchant::find($request->hidden_id);
        if ($request->file('logo')) {
            if ($update_merchant->logo) {
                File::delete($update_merchant->logo);
            }
            $update_merchant->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }
        $update_merchant->identification_type = $request->identification_type;
        if ($request->identification_type == 1) {
            if (empty($update_merchant->nid_photo)) {
                //$rules['nid_photo'] = "required|image";
            }
            if (empty($update_merchant->nid_photo_back)) {
                //$rules['nid_photo_back'] = "required|image";
            }
            $update_merchant->nidnumber = $request->nidnumber;
            if ($request->file('nid_photo')) {
                if ($update_merchant->nid_photo) {
                    File::delete($update_merchant->nid_photo);
                }
                $update_merchant->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
            if ($request->file('nid_photo_back')) {
                if ($update_merchant->nid_photo_back) {
                    File::delete($update_merchant->nid_photo_back);
                }
                $update_merchant->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 2) {
            if (empty($update_merchant->birth_certificate_photo)) {
                //$rules['birth_certificate_photo'] = "required|image";
            }
            $update_merchant->birth_certificate_no = $request->birth_certificate_no;
            if ($request->file('birth_certificate_photo')) {
                if ($update_merchant->birth_certificate_photo) {
                    File::delete($update_merchant->birth_certificate_photo);
                }
                $update_merchant->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 3) {
            if (empty($update_merchant->driving_licence_photo)) {
                // $rules['driving_licence_photo'] = "required|image";
            }

            $update_merchant->driving_licence_no = $request->driving_licence_no;
            if ($request->file('driving_licence_photo')) {
                if ($update_merchant->driving_licence_photo) {
                    File::delete($update_merchant->driving_licence_photo);
                }
                $update_merchant->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
            }
        }
        $this->validate($request, $rules);

        $update_merchant->phoneNumber = $request->phoneNumber;
        $update_merchant->firstName = $request->firstName;
        $update_merchant->companyName = $request->companyName;
        $update_merchant->fathers_name = $request->fathers_name;
        $update_merchant->mothers_name = $request->mothers_name;
        $update_merchant->trade_licence_no = $request->trade_licence_no;
        $update_merchant->website = $request->website;
        $update_merchant->facebook_page = $request->facebook_page;
        $update_merchant->pickup_thana_id = $request->pickup_thana_id;
        $update_merchant->pickLocation = $request->pickLocation;
        $update_merchant->pickupPreference = $request->pickupPreference;
        $update_merchant->nidnumber = $request->nidnumber;
        $update_merchant->division_id = $request->division_id;
        $update_merchant->district_id = $request->district_id;
        $update_merchant->thana_id = $request->thana_id;
        $update_merchant->area_id = $request->area_id;
        $update_merchant->present_address = $request->present_address;
        $update_merchant->permanent_address = $request->permanent_address;
        $update_merchant->acqm_id = $request->acq_manager;
        $update_merchant->del_commission = $request->del_commission;
        $update_merchant->fixed_charge = $request->fixed_charge;
        $update_merchant->cod_commission = $request->cod_commission;
        $update_merchant->inside_city = $request->inside_city;
        $update_merchant->sub_city = $request->sub_city;
        $update_merchant->outside_city = $request->outside_city;
        $update_merchant->nearestZone = $request->nearestZone;
        $update_merchant->paymentMethod = $request->paymentMethod;
        $update_merchant->payoption = $request->paymentMethod;
        $update_merchant->withdrawal = $request->withdrawal;
        $update_merchant->nameOfBank = $request->bank_name;
        $update_merchant->bankBranch = $request->branch_name;
        $update_merchant->bankAcHolder = $request->ac_holder_name;
        $update_merchant->bankAcNo = $request->bank_ac_no;
        $update_merchant->bkashNumber = $request->bkashNumber;
        $update_merchant->roketNumber = $request->roketNumber;
        $update_merchant->nogodNumber = $request->nogodNumber;
        $update_merchant->status = $request->status;

        if ($request->password) {
            $update_merchant->password = bcrypt($request->password);
        }

        if ($request->paymentMethod == 1) {
            $update_merchant->nameOfBank = $request->bank_name;
            $update_merchant->bankBranch = $request->branch_name;
            $update_merchant->bankAcHolder = $request->ac_holder_name;
            $update_merchant->bankAcNo = $request->bank_ac_no;
        } elseif ($request->paymentMethod == 2) {
            $update_merchant->bkashNumber = $request->bkashNumber;
        } elseif ($request->paymentMethod == 3) {
            $update_merchant->nogodNumber = $request->nogodNumber;
        }

        $update_merchant->save();
        // return $request->excluded_weights;
        // return $update_merchant->id;
        // MerchantExcludedWeights::where('merchant_id', $request->hidden_id)->delete();
        // // return 'deleted';

        // if ($request->excluded_weights) {
        //     for ($i = 0; $i < sizeof($request->excluded_weights); $i++) {
        //         $excluded_weights = [
        //             'merchant_id'   => $update_merchant->id,
        //             'weight_id'     => $request->excluded_weights[$i],
        //             'created_at'    => now(),
        //             'updated_at'    => now(),
        //         ];

        //         MerchantExcludedWeights::create($excluded_weights);
        //     }
        // }

        return redirect()->back()->with('success', 'Merchant Updated successfully');
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
    }
}
