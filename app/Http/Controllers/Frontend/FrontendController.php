<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Deliverycharge;
use App\Models\Division;
use App\Models\Feature;
use App\Models\Hub;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    // load homepage
    public function home()
    {
        $abouts = About::where('status', 1)->limit(1)->orderBy('id', 'DESC')->get();
        $sliders = Slider::where(['status' => 1])->orderBy('sort')->get();
        $services = Service::where(['status' => 1])->get();
        $hubs = Hub::all();
        $featuers = Feature::all();
        $delivery_charges = Deliverycharge::with('deliveryChargeHead')->orderBy('id', 'DESC')->get();
        $weights = Weight::all();
        // return $delivery_charges;
        return view('frontend.pages.home', compact('sliders', 'abouts', 'services', 'hubs', 'featuers', 'weights', 'delivery_charges'));
    }

    // track parcel
    public function trackParcel(Request $request)
    {
        $tracking_id = $request->tracking_id;
        $tracking_data = [];
        $trackInfos = [];
        if ($tracking_id) {
            $tracking_data = Parcel::where('trackingCode', $tracking_id)->with('deliveryman')->first();
            // return $tracking_data;
            if ($tracking_data) {
                $trackInfos = Parcelnote::where('parcelId', $tracking_data->id)->orderBy('id', 'ASC')->get();
            }
            // return $trackInfos;
        }

        return view('frontend.pages.tracking', compact('tracking_data', 'trackInfos'));
    }

    // Merchant registration
    public function merchantRegistration(Request $request)
    {
        $phoneNumber = $request->phoneNumber;
        $msg = '';
        if ($request->phoneNumber) {
            $this->validate($request, [
                  'phoneNumber' => 'bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
            ]);
            // Verify code generate
            $verifyToken = rand(111111, 999999);
            $numbers = $request->phoneNumber;
            $msg = 'Welcome! Please submit your verify code. ';

            $exist = Merchant::where('phoneNumber', $request->phoneNumber)->first();
            if ($exist) {
                if ($exist->verify == 1 && $exist->firstName) {
                    return redirect('merchant/register')->with('error', 'This number already taken.');
                } else {
                    $exist->update(['verify' => $verifyToken, 'status' => 0]);
                    $numbers = $request->phoneNumber;
                    $msg = 'Welcome! Please submit your verify code. ';
                    $sms = 'Welcome! Your verify code is ' . $verifyToken;
                    $this->sendOTPSMS($numbers, $sms);
                    Session::put('merchant_id', $exist->id);
                }
            } else {
                $merchant = Merchant::create([
                    'phoneNumber' => $request->phoneNumber,
                    'verify' => $verifyToken,
                    'password' => bcrypt($request->phoneNumber),
                    'status' => 0,
                ]);
                $numbers = $request->phoneNumber;
                $msg = 'Welcome! Please submit your verify code. ';
                $sms = 'Welcome! Your verify code is ' . $verifyToken;
                $this->sendOTPSMS($numbers, $sms);
                Session::put('merchant_id', $merchant->id);
            }
        }

        $verify_code = $request->verify_code;
        $form_show = false;
        if ($request->verify_code && Session::get('merchant_id')) {
            $merchant = Merchant::where('phoneNumber', $request->mobile_no)->where('verify', $request->verify_code)->first();
            if ($merchant) {
                $merchant->update([
                    'verify' => 0,
                    'status' => 1,
                    'api_token' => Str::random(50),
                ]);
                $msg = 'Welcome! Your account verified successfully done. The ( * ) field is required.';
                $form_show = true;
            } else {
                $phoneNumber = $request->mobile_no;
                $verify_code = null;
                $msg = 'Opps! INVALID CODE.';
            }
        }
        $divisions = Division::orderBy('name')->where('status', 1)->get();

        return view('frontend.pages.merchantregister', compact('phoneNumber', 'verify_code', 'msg', 'divisions', 'form_show'));
    }

    // merchant registration operation
    public function merchantRegister(Request $request)
    {
        // validate merchant inputs
        $this->validate($request, [
            'firstName' => 'required|max:150',
            //'otherphoneNumber' => 'nullable|numeric|digits:11',
            'companyName' => 'required|max:150',
            'emailAddress' => 'nullable|email',
            'pickLocation' => 'required',
            //'identification_type' => 'required|numeric',
            //'nidnumber' => 'required_if:identification_type,=,1',
            //'nid_photo' => 'image|required_if:identification_type,=,1',
            //'nid_photo_back' => 'image|required_if:identification_type,=,1',
            //'birth_certificate_no' => 'required_if:identification_type,=,2',
            //'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
            //'driving_licence_no' => 'required_if:identification_type,=,3',
            //'driving_licence_photo' => 'image|required_if:identification_type,=,3',
            'division_id' => 'required',
            'district_id' => 'required',
            'payoption' => 'required',
            'password' => 'required|same:confirmed|min:6',
            'confirmed' => 'required',
        ]);

        $marchent = Merchant::find(Session::get('merchant_id'));
        if ($request->file('logo')) {
            $marchent->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }
        $marchent->identification_type = $request->identification_type;
        if ($request->identification_type == 1) {
            $marchent->nidnumber = $request->nidnumber;
            if ($request->file('nid_photo')) {
                $marchent->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
            if ($request->file('nid_photo_back')) {
                $marchent->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 2) {
            $marchent->birth_certificate_no = $request->birth_certificate_no;
            if ($request->file('birth_certificate_photo')) {
                $marchent->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 3) {
            $marchent->driving_licence_no = $request->driving_licence_no;
            if ($request->file('driving_licence_photo')) {
                $marchent->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
            }
        }

        $marchent->payoption = $request->payoption;
        if ($request->payoption == 1) {
            $marchent->nameOfBank = $request->bank_name;
            $marchent->bankBranch = $request->branch_name;
            $marchent->bankAcHolder = $request->ac_holder_name;
            $marchent->bankAcNo = $request->bank_ac_no;
        } elseif ($request->payoption == 2) {
            $marchent->bkashNumber = $request->bNumber;
        } elseif ($request->payoption == 3) {
            $marchent->nogodNumber = $request->nNumber;
        } elseif ($request->payoption == 4) {
        } else {
            return redirect()->back()->with('error', 'Opps! Some thing is wrong');
        }

        $marchent->companyName = $request->companyName;
        $marchent->firstName = $request->firstName;
        $marchent->otherphoneNumber   =   $request->otherphoneNumber;
        $marchent->emailAddress = $request->emailAddress;
        $marchent->username = $request->username;
        $marchent->fathers_name = $request->fathers_name;
        $marchent->mothers_name = $request->mothers_name;
        $marchent->mothers_name = $request->mothers_name;
        $marchent->date_of_birth = $request->date_of_birth ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
        $marchent->trade_licence_no = $request->trade_licence_no;
        $marchent->facebook_page = $request->facebook_page;
        $marchent->website = $request->website;
        $marchent->division_id = $request->division_id;
        $marchent->district_id = $request->district_id;
        $marchent->thana_id = $request->thana_id;
        $marchent->area_id = $request->area_id;
        $marchent->present_address = $request->present_address;
        $marchent->permanent_address = $request->permanent_address;
        $marchent->pickLocation = $request->pickLocation;
        $marchent->pickupPreference = $request->pickupPreference;
        $marchent->paymentMethod = $request->payoption;
        $marchent->verify = 1;
        $marchent->status = 1;
        $marchent->agree = 1;
        $marchent->password = bcrypt(request('password'));
        $marchent->save();
        $merchantId = $marchent->id;

        return redirect()->route('signin')->with('You may login now');
    }

    // privacy & policy
    public function privacyPOlicy()
    {
        return view('frontend.pages.privacy');
    }

    // signin
    public function signIn()
    {
        return view('frontend.pages.signin');
    }
}
