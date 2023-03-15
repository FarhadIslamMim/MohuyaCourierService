<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Codcharge;
use App\Models\Deliverycharge;
use App\Models\DeliveryChargeHead;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\MerchantExcludedWeights;
use App\Models\Merchantpayment;
use App\Models\PackageExcludedWeights;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\PromotionalDiscount;
use App\Models\Setting;
use App\Models\Thana;
use App\Models\Weight;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use illuminate\support\str;

class MerchantApiController extends Controller
{
    /**
     * Method login
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function login(Request $request)
    {
        $rules = [
            'merchant_user' => 'required',
            'merchant_password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $checkAuth = Merchant::where('emailAddress', $request->merchant_user)
            ->orWhere('phoneNumber', $request->merchant_user)
            ->first();

        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                return response()->json(['success' => false, 'message' => 'Opps! your account has been suspend'], 200);
            } else {
                if (password_verify($request->merchant_password, $checkAuth->password)) {
                    return response()->json(['success' => true, 'data' => $checkAuth, 'message' => 'Thanks, Logged in successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Sorry! your password is wrong'], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! you have no account'], 200);
        }
    }

    /**
     * Method sendOTP
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function sendOTP(Request $request)
    {
        $rules = [
            'phoneNumber' => 'numeric|digits:11'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $verifyToken = rand(111111, 999999);
        $exist = Merchant::where('phoneNumber', $request->phoneNumber)->first();
        if ($exist) {
            if ($exist->verify == 1 && $exist->firstName) {
                return response()->json(['success' => false, 'message' => 'This number already taken.'], 200);
            } else {
                $exist->update(['verify' => $verifyToken]);
                $number = $request->phoneNumber;
                $sms = "Welcome! Your verify code is " . $verifyToken;
                $this->sendOTPSMS($number, $sms);
                return response()->json(['success' => true, 'message' => 'Welcome! Please submit your verify code.'], 200);
            }
        } else {
            $merchant = Merchant::create([
                'phoneNumber' => $request->phoneNumber,
                'verify' => $verifyToken,
                'password' => bcrypt($request->phoneNumber),
            ]);
            $number = $request->phoneNumber;
            $sms = "Welcome! Your verify code is " . $verifyToken;
            $this->sendOTPSMS($number, $sms);
            return response()->json(['success' => true, 'message' => 'Welcome! Please submit your verify code.'], 200);
        }
    }

    /**
     * Method verifyOTP
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function verifyOTP(Request $request)
    {
        $rules = [
            'verify_code' => 'required',
            'phoneNumber' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $merchant = Merchant::where('phoneNumber', $request->phoneNumber)->where('verify', $request->verify_code)->first();
        if ($merchant) {
            $merchant->update([
                'verify' => 0,
                'status' => 0,
                'api_token' => Str::random(50)
            ]);
            $msg = "Welcome! Your account verified successfully done.";
            return response()->json(['success' => true, 'message' => $msg], 200);
        } else {
            $msg = "Opps! Invalid CODE.";
            return response()->json(['success' => false, 'message' => $msg], 200);
        }
    }

    public function registration(Request $request)
    {

        $rules = [
            'phoneNumber' => 'required|numeric|digits:11',
            'firstName' => 'required|max:150',
            'companyName' => 'required|max:150',
            'logo' => 'nullable|image',
            'emailAddress' => 'nullable|email',
            'identification_type' => 'required|numeric',
            'nidnumber' => 'required_if:identification_type,=,1',
            // 'nid_photo' => 'image|required_if:identification_type,=,1',
            // 'nid_photo_back' => 'image|required_if:identification_type,=,1',
            'birth_certificate_no' => 'required_if:identification_type,=,2',
            'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
            'driving_licence_no' => 'required_if:identification_type,=,3',
            'driving_licence_photo' => 'image|required_if:identification_type,=,3',
            'division_id' => 'required',
            'district_id' => 'required',
            'payoption' => 'required',
            'password' => 'required|same:confirmed|min:6',
            'confirmed' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $marchent = Merchant::where('phoneNumber', $request->phoneNumber)->first();

        if ($marchent) {
            if ($request->file('logo')) {
                $marchent->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
            }
            $marchent->identification_type     =   $request->identification_type;
            if ($request->identification_type == 1) {
                $marchent->nidnumber     =   $request->nidnumber;
                if ($request->file('nid_photo')) {
                    $marchent->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
                }
                if ($request->file('nid_photo_back')) {
                    $marchent->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
                }
            } elseif ($request->identification_type == 2) {
                $marchent->birth_certificate_no     =   $request->birth_certificate_no;
                if ($request->file('birth_certificate_photo')) {
                    $marchent->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
                }
            } elseif ($request->identification_type == 3) {
                $marchent->driving_licence_no     =   $request->driving_licence_no;
                if ($request->file('driving_licence_no')) {
                    $marchent->driving_licence_no = $this->fileUpload($request->file('driving_licence_no'), 'public/uploads/merchant/', 324, 204);
                }
            }

            $marchent->payoption     =   $request->payoption;
            if ($request->payoption == 1) {
                $marchent->nameOfBank   =   $request->bank_name;
                $marchent->bankBranch   =   $request->branch_name;
                $marchent->bankAcHolder   =   $request->ac_holder_name;
                $marchent->bankAcNo   =   $request->bank_ac_no;
            } elseif ($request->payoption == 2) {
                $marchent->bkashNumber   =   $request->bNumber;
            } elseif ($request->payoption == 3) {
                $marchent->nogodNumber  =   $request->nNumber;
            } elseif ($request->payoption == 4) {
                //
            } else {
                return response()->json(['success' => false, 'message' => 'Opps! Some thing is wrong'], 200);
            }

            $marchent->companyName   =   $request->companyName;
            $marchent->firstName     =   $request->firstName;
            // $marchent->phoneNumber   =   $request->phoneNumber;
            $marchent->emailAddress  =   $request->emailAddress;
            $marchent->username      =   $request->username;
            $marchent->fathers_name     =   $request->fathers_name;
            $marchent->mothers_name     =   $request->mothers_name;
            $marchent->mothers_name     =   $request->mothers_name;
            $marchent->date_of_birth     =   $request->date_of_birth ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
            $marchent->trade_licence_no  =   $request->trade_licence_no;
            $marchent->facebook_page  =   $request->facebook_page;
            $marchent->website  =   $request->website;
            $marchent->division_id  =   $request->division_id;
            $marchent->district_id  =   $request->district_id;
            $marchent->thana_id  =   $request->thana_id;
            $marchent->area_id  =   $request->area_id;
            $marchent->present_address  =   $request->present_address;
            $marchent->permanent_address  =   $request->permanent_address;
            $marchent->pickLocation  =   $request->pickup_address;
            $marchent->pickupPreference  =   $request->pickupPreference;
            $marchent->facebook_page  =   $request->facebook_page;
            $marchent->paymentMethod =   $request->payoption;
            $marchent->verify        =   1;
            $marchent->status        =   1;
            $marchent->agree         =   1;
            $marchent->password      =    bcrypt(request('password'));
            $marchent->api_token  =    Str::random(50);
            $marchent->save();
            return response()->json(['success' => true, 'message' => 'Thanks , You are successfully registered.'], 200);
        } else {
            $msg = "Opps, There are no merchant for this phone number.";
            return response()->json(['success' => false, 'message' => $msg], 200);
        }
    }

    public function profileUpdate(Request $request)
    {

        $rules = [];
        $rules['logo'] = "nullable|image";
        $rules['firstName'] = "required";
        $rules['identification_type'] = "required";
        $rules['division_id'] = "required";
        $rules['district_id'] = "required";


        try {
            // return response()->json(['success' => false, 'message' => "on developement"], 200);
            $update_merchant = $this->merchant($request->api_token);

            if ($update_merchant) {
                if ($request->file('logo')) {
                    if ($update_merchant->logo) {
                        File::delete($update_merchant->logo);
                    }
                    $update_merchant->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
                }
                $update_merchant->identification_type     =   $request->identification_type;
                if ($request->identification_type == 1) {
                    if (empty($update_merchant->nid_photo)) {
                        $rules['nid_photo'] = "required|image";
                    }
                    $update_merchant->nidnumber     =   $request->nidnumber;
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
                        $rules['birth_certificate_photo'] = "required|image";
                    }
                    $update_merchant->birth_certificate_no     =   $request->birth_certificate_no;
                    if ($request->file('birth_certificate_photo')) {
                        if ($update_merchant->birth_certificate_photo) {
                            File::delete($update_merchant->birth_certificate_photo);
                        }
                        $update_merchant->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
                    }
                } elseif ($request->identification_type == 3) {
                    if (empty($update_merchant->driving_licence_photo)) {
                        $rules['driving_licence_photo'] = "required|image";
                    }

                    $update_merchant->driving_licence_no     =   $request->driving_licence_no;
                    if ($request->file('driving_licence_photo')) {
                        if ($update_merchant->driving_licence_photo) {
                            File::delete($update_merchant->driving_licence_photo);
                        }
                        $update_merchant->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
                    }
                }

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
                }

                $update_merchant->firstName = $request->firstName;
                // $update_merchant->phoneNumber = $request->phoneNumber;
                $update_merchant->emailAddress  =   $request->emailAddress;
                $update_merchant->fathers_name = $request->fathers_name;
                $update_merchant->mothers_name = $request->mothers_name;
                $update_merchant->present_address = $request->present_address;
                $update_merchant->permanent_address = $request->permanent_address;
                $update_merchant->otherphoneNumber = $request->otherphoneNumber;
                // $update_merchant->mAdress = $request->mAdress;
                $update_merchant->pickLocation = $request->pickLocation;
                $update_merchant->division_id = $request->division_id;
                $update_merchant->district_id = $request->district_id;
                $update_merchant->thana_id = $request->thana_id;
                $update_merchant->area_id = $request->area_id;
                // $update_merchant->pickupPreference = $request->pickupPreference;
                // $update_merchant->paymentMethod = $request->paymentMethod;
                // $update_merchant->withdrawal = $request->withdrawal;
                // $update_merchant->nameOfBank = $request->nameOfBank;
                // $update_merchant->bankBranch = $request->bankBranch;
                // $update_merchant->bankAcHolder = $request->bankAcHolder;
                // $update_merchant->bankAcNo = $request->bankAcNo;
                // $update_merchant->bkashNumber = $request->bkashNumber;
                // $update_merchant->roketNumber = $request->roketNumber;
                // $update_merchant->nogodNumber = $request->nogodNumber;
                // $update_merchant->nidnumber = $request->nidnumber;
                // $update_merchant->trade_licence_no = $request->trade_licence_no;
                // $update_merchant->facebook_page  =   $request->facebook_page;
                // $update_merchant->website  =   $request->website;
                $update_merchant->save();
                return response()->json(['success' => true, 'message' => 'Thanks , Your profile successfully updated.'], 200);
            } else {
                $msg = "Opps, There are no merchant for this phone number.";
                return response()->json(['success' => false, 'message' => $msg], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->message], 200);
        }
    }


    // Merchant Profile Edit
    // public function profileUpdate(Request $request)
    // {
    //     $rules = [];
    //     $rules['firstName'] = "required";
    //     $rules['identification_type'] = "required";
    //     $rules['division_id'] = "required";
    //     $rules['district_id'] = "required";

    //     $update_merchant = Merchant::find(Session::get('merchantId'));
    //     $update_merchant->identification_type     =   $request->identification_type;
    //     if ($request->identification_type == 1) {
    //         if (empty($update_merchant->nid_photo)) {
    //             $rules['nid_photo'] = "required|image";
    //         }
    //         $update_merchant->nidnumber     =   $request->nidnumber;
    //         if ($request->file('nid_photo')) {
    //             if ($update_merchant->nid_photo) {
    //                 File::delete($update_merchant->nid_photo);
    //             }
    //             $update_merchant->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //         if ($request->file('nid_photo_back')) {
    //             if ($update_merchant->nid_photo_back) {
    //                 File::delete($update_merchant->nid_photo_back);
    //             }
    //             $update_merchant->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     } elseif ($request->identification_type == 2) {
    //         if (empty($update_merchant->birth_certificate_photo)) {
    //             $rules['birth_certificate_photo'] = "required|image";
    //         }
    //         $update_merchant->birth_certificate_no     =   $request->birth_certificate_no;
    //         if ($request->file('birth_certificate_photo')) {
    //             if ($update_merchant->birth_certificate_photo) {
    //                 File::delete($update_merchant->birth_certificate_photo);
    //             }
    //             $update_merchant->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     } elseif ($request->identification_type == 3) {
    //         if (empty($update_merchant->driving_licence_photo)) {
    //             $rules['driving_licence_photo'] = "required|image";
    //         }

    //         $update_merchant->driving_licence_no     =   $request->driving_licence_no;
    //         if ($request->file('driving_licence_photo')) {
    //             if ($update_merchant->driving_licence_photo) {
    //                 File::delete($update_merchant->driving_licence_photo);
    //             }
    //             $update_merchant->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     }
    //     $this->validate($request, $rules);
    //     $update_merchant->firstName = $request->firstName;
    //     // $update_merchant->phoneNumber = $request->phoneNumber;
    //     $update_merchant->fathers_name = $request->fathers_name;
    //     $update_merchant->mothers_name = $request->mothers_name;
    //     $update_merchant->present_address = $request->present_address;
    //     $update_merchant->permanent_address = $request->permanent_address;
    //     $update_merchant->otherphoneNumber = $request->otherphoneNumber;
    //     $update_merchant->mAdress = $request->mAdress;
    //     $update_merchant->pickLocation = $request->pickLocation;
    //     $update_merchant->division_id = $request->division_id;
    //     $update_merchant->district_id = $request->district_id;
    //     $update_merchant->thana_id = $request->thana_id;
    //     $update_merchant->area_id = $request->area_id;
    //     $update_merchant->pickupPreference = $request->pickupPreference;
    //     $update_merchant->paymentMethod = $request->paymentMethod;
    //     $update_merchant->withdrawal = $request->withdrawal;
    //     $update_merchant->nameOfBank = $request->nameOfBank;
    //     $update_merchant->bankBranch = $request->bankBranch;
    //     $update_merchant->bankAcHolder = $request->bankAcHolder;
    //     $update_merchant->bankAcNo = $request->bankAcNo;
    //     $update_merchant->bkashNumber = $request->bkashNumber;
    //     $update_merchant->roketNumber = $request->roketNumber;
    //     $update_merchant->nogodNumber = $request->nogodNumber;
    //     $update_merchant->nidnumber = $request->nidnumber;
    //     $update_merchant->trade_licence_no = $request->trade_licence_no;
    //     $update_merchant->facebook_page  =   $request->facebook_page;
    //     $update_merchant->website  =   $request->website;
    //     $update_merchant->save();
    //     return redirect()->back()->with('success', 'Your account update successfully');
    // }




    public function removeUpdateImage($update_merchant)
    {
        if ($update_merchant->nid_photo) {
            File::delete($update_merchant->nid_photo);
        }
        if ($update_merchant->birth_certificate_photo) {
            File::delete($update_merchant->birth_certificate_photo);
        }
        if ($update_merchant->driving_licence_no) {
            File::delete($update_merchant->driving_licence_no);
        }
    }

    /**
     * Method dashboard
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function dashboard(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            // $returnDelCharge = DB::table('parcels')->where([
            //     ['merchantId', '=', $user->id],
            //     ['status', '>', '5'],
            //     ['status', '<', '9'],
            // ])->sum('deliveryCharge');

            // $prepDelAmount = Parcel::where(['merchantId' => $user->id, 'status' => 4, 'percelType' => 1])->sum('deliveryCharge');
            // $allPaidParcels = Parcel::where(['merchantId' => $user->id, 'merchantpayStatus' => 1])->get();

            // $total = 0;
            // $totalDel = 0;
            // foreach ($allPaidParcels as $key => $parcel) {
            //     if (($parcel->status > 5 && $parcel->status < 9) || (($parcel->percelType == 1) && ($parcel->status == 4))) {
            //         $totalDel += $parcel->deliveryCharge;
            //     } else {
            //         if (($parcel->status == 4) && ($parcel->percelType == 2)) {
            //             $total += $parcel->merchantPaid;
            //         }
            //     }
            // }
            // $return = [22];
            
      
            
             // total parcel details
            $total_percel = Parcel::where(['merchantId' => $user->id])->count();
            $total_pending = Parcel::where(['merchantId' => $user->id, 'status' => 1])->count();
            $total_picked = Parcel::where(['merchantId' => $user->id, 'status' => 2])->count();
            $total_transit = Parcel::where(['merchantId' => $user->id, 'status' => 3])->count();
            $total_delivered = Parcel::where(['merchantId' => $user->id, 'status' => 4])->count();
            $return_to_marchent = Parcel::where(['merchantId' => $user->id, 'status' => 8])->count();
            $return_to_pending = Parcel::where(['merchantId' => $user->id, 'status' => 6])->count();
            $return_to_hub = Parcel::where(['merchantId' => $user->id, 'status' => 7])->count();
            $total_cancel = Parcel::where(['merchantId' => $user->id, 'status' => 9])->count();
            $total_hold = Parcel::where(['merchantId' => $user->id, 'status' => 5])->count();
            $total_partial_return = Parcel::where(['merchantId' =>  $user->id,])->select('partial_return_amount')->sum('partial_return_amount');
            $totalamount = Parcel::where('status', 4)->where('merchantID', $user->id,)->sum('merchantAmount');
            $merchantPaid = Parcel::where('status', 4)->where('merchantID', $user->id,)->sum('merchantAmount');
            $merchantUnpaid = Parcel::where('status', 4)->where('merchantID',$user->id,)->sum('merchantDue');
            
             $total_paid_amount = $merchantPaid - $merchantUnpaid;
             $total_unpaid_amount =  $merchantUnpaid;
            
            //today percel details
            
             $today_parcel = Parcel::where(['merchantId' => $user->id])->whereDate('created_at', Carbon::today())->count();
             $today_pending = Parcel::where(['merchantId' => $user->id, 'status' => 1])->whereDate('created_at', Carbon::today())->count();
             $today_picked = Parcel::where(['merchantId' => $user->id, 'status' => 2])->whereDate('created_at', Carbon::today())->count();
             $today_transit = Parcel::where(['merchantId' => $user->id, 'status' => 3])->whereDate('created_at', Carbon::today())->count();
             $today_hold = Parcel::where(['merchantId' => $user->id, 'status' => 5])->whereDate('created_at', Carbon::today())->count();
             $today_delivered = Parcel::where(['merchantId' => $user->id, 'status' => 4])->whereDate('created_at', Carbon::today())->count();
             $today_cancel =  Parcel::where(['merchantId' => $user->id, 'status' => 9])->whereDate('created_at', Carbon::today())->count();
             $today_return_to_pending = Parcel::where(['merchantId' => $user->id, 'status' => 6])->whereDate('created_at', Carbon::today())->count();
             $today_return_to_hub = Parcel::where(['merchantId' => $user->id, 'status' => 7])->whereDate('created_at', Carbon::today())->count();
             $today_return_to_merchant = Parcel::where(['merchantId' => $user->id, 'status' => 8])->whereDate('created_at', Carbon::today())->count();
             
             $today_pertial_return_amount = Parcel::where(['merchantId' => $user->id])->select('partial_return_amount')->whereDate('created_at', Carbon::today())->sum('partial_return_amount');
             $today_amount = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', $user->id)->sum('merchantAmount');
            
             $today_merchantPaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', $user->id)->sum('merchantAmount');

             $today_merchantUnPaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', $user->id)->sum('merchantDue');

             $today_paid_amount  = $today_merchantPaid - $today_merchantUnPaid;
             
             $today_unpaid_amount = $today_merchantUnPaid;
             
            $data = [
                     'today_parcel' => $today_parcel,
                     'today_pending' => $today_pending,
                     'today_picked' => $today_picked,
                     'today_transit' => $today_transit,
                     'today_hold' => $today_hold,
                     'today_delivered' => $today_delivered,
                     'today_cancel' => $today_cancel,
                     'today_return_to_pending' => $today_return_to_pending,
                     'today_return_to_hub' => $today_return_to_hub,
                     'today_return_to_merchant' => $today_return_to_merchant,
                     'today_pertial_return_amount' => $today_pertial_return_amount,
                     'today_amount' => $today_amount,
                     'today_paid_amount' => $today_paid_amount,
                     'today_unpaid_amount' => $today_unpaid_amount,
                
                   'total_percel' => $total_percel,
                   'total_pending' => $total_pending,
                   'total_picked' => $total_picked,
                   'total_transit' => $total_transit,
                   'total_delivered' => $total_delivered,
                   'returb_to_marchent' =>$return_to_marchent,
                   'return_to_pending' =>$return_to_pending,
                   'return_to_hub' =>$return_to_hub,
                   'total_cancel' =>$total_cancel,
                   'total_hold'=>$total_hold,
                   'total_partial_return' => $total_partial_return,
                   'totalamount'=>$totalamount,
                   'total_paid_amount'=>$total_paid_amount,
                   'total_unpaid_amount'=>$total_unpaid_amount,
                  
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method profile
     *
     * @param Request $request API Token
     *
     * @return void
     */
    public function profile(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            return response()->json(['success' => true, 'data' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method getDivision
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getDivision(Request $request)
    {
        $data = Division::orderBy('name')->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Method getDistrictByDivision
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getDistrictByDivision(Request $request)
    {
        $rules = [
            'division_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = District::orderBy('name')->where('division_id', $request->division_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Method getThanaByDistrict
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getThanaByDistrict(Request $request)
    {
        $rules = [
            'district_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = Thana::orderBy('name')->where('district_id', $request->district_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Method getAreaByThana
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getAreaByThana(Request $request)
    {
        $rules = [
            'thana_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = Area::orderBy('name')->where('thana_id', $request->thana_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Method parcelcreate
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function parcelcreate(Request $request)
    {
        $user = $this->merchant($request->api_token);

        if ($user) {
            $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
            $divisions = Division::orderBy('name')->where('status', 1)->get();
            $districts = District::orderBy('name')->where('status', 1)->get();
            $codcharge = Codcharge::where('status', 1)->orderBy('id', 'DESC')->first();
            $merchant = Merchant::where('id', $user->id)->select('id', 'firstName', 'companyName')->first();
            $weights = Weight::where('status', 1)->get();
            $data = [
                // 'delivery_charge_heads' => $delivery_charge_heads,
                'divisions' => $divisions,
                'districts' => $districts,
                // 'codcharge' => $codcharge,
                'merchant' => $merchant,
                'weights' => $weights,
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method costCalculate
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function costCalculate(Request $request)
    {
        $user = $this->merchant($request->api_token);

        if ($user) {
            $mercharntInfo = $user;
            
           


            $thana = Thana::find($request->thana_id);
            $division = $request->division_id;
            $district = $request->district_id;
            $thana_id = $request->thana_id;
    
    
            $inside_city = $mercharntInfo->inside_city;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id)->get();
    
            // get subcity list
            $sub_city = $mercharntInfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id)->get();
    
            // get outside list
            $district_id = $request->district_id;
    
            $outside_city = $mercharntInfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();
    
    
            $excluded_weights = [];
            $excluded_weights_last_id = 0;
    
            if (count($get_packages_inside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_sub_city)) {
    
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_outside_city)) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
    
    
    
            $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
            $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();
    
            $last_extra_weight = $weight_last_value->extra_weight ?? 0;
    
            if (empty($thana->deliverycharge_id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your selected thana is disabled.',
                ]);
            }
    
    
    
    
            if (!empty($weight)) {
    
    
                $delivery_charge = [];
    
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                    
                    $data = [
                        'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
                if (count($get_packages_sub_city) > 0) {
    
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    // return $package; 
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
    
                    $data = [
                         'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                    
                    $data = [
                        'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
    
                $extra_weight = $weight->extra_weight - 0;
    
                // return $weight;
                // get deliverycharge
                // return $thana->deliverycharge_id;
                $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();
    
                // return $deliveryChargeInfo;
    
    
    
    
    
                if ($mercharntInfo->fixed_charge) {
                    $delivery_charge = $mercharntInfo->fixed_charge;
                    $codcharge = 0;
                }
    
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);
    
                // Extra charge
                // return $weight;
    
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);
    
    
    
                // Promotional discount
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
    
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }
                $delivery_charge = $delivery_charge - $promotiuonal_discount;
    
                    $data = [
                       'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($delivery_charge, 2),
                        'pcodecharge' => number_format($codcharge, 2),
                        'total_charge' => number_format(($delivery_charge + $codcharge), 2),
                        'pay_to_merchant' => number_format($request->productPrice - ($delivery_charge + $codcharge), 2),
                        'promotiuonal_discount' => number_format(($promotiuonal_discount), 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
            } else {
    
    
                $inside_city = $mercharntInfo->inside_city;
                $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id)->get();
    
                // get subcity list
                $sub_city = $mercharntInfo->sub_city;
                $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id)->get();
    
    
    
                // get outside list
                $district_id = $request->district_id;
    
                $outside_city = $mercharntInfo->outside_city;
                $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();
    
    
                $delivery_charge = [];
    
                if (count($get_packages_inside_city) > 0) {
    
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = 0;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                    // return $total_charge;
                    
                     $data = [
                       'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
                if (count($get_packages_sub_city) > 0) {
    
                    $package = DeliveryPackage::where('id', $sub_city)->first();
    
                    $extra_weight = 0;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
    
                    $data = [
                       'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = 0;
                    $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                    
                    $data = [
                        'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                        'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                        'total_charge' => number_format($total_charge, 2),
                        'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);
                }
    
    
                $delivery_charge = [];
    
                // get deliverycharge
                $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();
    
    
    
                if ($mercharntInfo->fixed_charge) {
                    $delivery_charge = $mercharntInfo->fixed_charge;
                    $codcharge = 0;
                }
    
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);
    
                // Extra charge
                // return $weight;
                $extra_weight = $weight->value - 1;
    
    
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);
    
                // return $delivery_charge;
                // Promotional discount
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
    
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }
                $delivery_charge = $delivery_charge - $promotiuonal_discount;
    
                // return $delivery_charge; 
                    $data = [
                        'codpay' => $request->productPrice,
                        'pdeliverycharge' => number_format($delivery_charge, 2),
                        'pcodecharge' => number_format($codcharge, 2),
                        'total_charge' => number_format(($delivery_charge + $codcharge), 2),
                        'pay_to_merchant' => number_format($request->productPrice - ($delivery_charge + $codcharge), 2),
                        'promotiuonal_discount' => number_format(($promotiuonal_discount), 2),
                    ];
                    
                    return response()->json(['success' => true, 'data' => $data], 200);

            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method parcelstore
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function parcelstore(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'phonenumber' => 'required|numeric|digits:11',
            'pickLocation' => 'required',
            'productPrice' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {

            $mercharntInfo = Merchant::where('id', $user->id)->first();
            $thana = Thana::find($request->thana_id);
            // get inside city list
            // get inside city list
            $inside_city = $mercharntInfo->inside_city;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana->id)->get();

            // get subcity list
            $sub_city = $mercharntInfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana->id)->get();


            // get outside list
            $district_id = $request->district_id;

            $outside_city = $mercharntInfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


            $excluded_weights = [];
            $excluded_weights_last_id = 1;

            if (count($get_packages_inside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_sub_city) > 0) {

                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();

                // return $excluded_weights;
            }
            if (count($get_packages_outside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }

            $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
            $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

            $last_extra_weight = $weight_last_value->extra_weight ?? 0;


            // return $get_packages_inside_city;
            if (empty($thana->deliverycharge_id)) {
                return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
            }

            $percelType = 1;

            if ($request->productPrice > 0) {
                $percelType = 2;  // COD Collection
            }
            $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();

            if ($mercharntInfo->fixed_charge) {
                $delivery_charge = $mercharntInfo->fixed_charge;
                $codcharge = 0;
            }



            if (!empty($weight)) {
                // get deliverycharge
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
                // Extra charge
                $extra_weight = $weight->value - 1;
                // return $extra_weight;
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

                // return $delivery_charge;
                // die();
                // Promotional Charge
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }
                $delivery_charge = $delivery_charge - $promotiuonal_discount;

                // return $delivery_charge;
                // cod charge
                // $codChargeInfo = Codcharge::where(['status' => 1])->first();
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


                // inside city packages
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }

                // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();

                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }

                // outside city package
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }


                // return $delivery_charge;

                $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount, 2);
                $setting = Setting::first();
                $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
                $store_parcel = new Parcel();
                $store_parcel->invoiceNo = $request->invoiceNo;
                $store_parcel->merchantId = $mercharntInfo->id;
                $store_parcel->cod = $request->productPrice;
                $store_parcel->percelType = $percelType;
                $store_parcel->recipientName = $request->name;
                $store_parcel->recipientAddress = $request->delivery_address;
                $store_parcel->recipientPhone = $request->phonenumber;
                $store_parcel->alternative_mobile_no = $request->alternative_mobile_no;
                $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $store_parcel->pickLocation = $mercharntInfo->pickLocation;
                $store_parcel->productWeight = $weight->value;
                $store_parcel->trackingCode = $tracking_code;
                $store_parcel->note = $request->note;
                $store_parcel->deliveryCharge = round($delivery_charge, 2);
                $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $store_parcel->codCharge = round($codcharge, 2);
                $store_parcel->division_id = $request->division_id;
                $store_parcel->district_id = $request->district_id;
                $store_parcel->thana_id = $request->thana_id;
                $store_parcel->area_id = $request->area_id;
                $store_parcel->delivery_address = $request->delivery_address;
                $store_parcel->productPrice = 0;
                $store_parcel->merchantAmount = $merchantAmount;
                $store_parcel->merchantDue = 0;
                $store_parcel->orderType = $deliveryChargeInfo->id;
                $store_parcel->codType = $deliveryChargeInfo->id;
                $store_parcel->status = 1;
                $store_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $store_parcel->id;
                $note->note = 'Parcel create successfully';
                $note->save();

                if ($store_parcel) {
                    $msg = 'Thanks! your parcel add successfully and your tracking code is : ' . $tracking_code;
                    return response()->json(['success' => true, 'message' => $msg], 200);
                }
            } else {



                $weight = Weight::find($request->weight_id);
                // get deliverycharge
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
                // Extra charge
                $extra_weight = $weight->value - 1;

                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

                // die();
                // Promotional Charge
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }
                $delivery_charge = $delivery_charge - $promotiuonal_discount;

                // cod charge
                // $codChargeInfo = Codcharge::where(['status' => 1])->first();
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

                // inside city packages
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }

                // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    // return $package;
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }

                // outside city package
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = 0;
                    // return "Weight " . $extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
                }

                // return $delivery_charge;

                $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount, 2);
                $setting = Setting::first();
                $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
                $store_parcel = new Parcel();
                $store_parcel->invoiceNo = $request->invoiceNo;
                $store_parcel->merchantId = $mercharntInfo->id;
                $store_parcel->cod = $request->productPrice;
                $store_parcel->percelType = $percelType;
                $store_parcel->recipientName = $request->name;
                $store_parcel->recipientAddress = $request->delivery_address;
                $store_parcel->recipientPhone = $request->phonenumber;
                $store_parcel->alternative_mobile_no = $request->alternative_mobile_no;
                $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $store_parcel->pickLocation = $mercharntInfo->pickLocation;
                $store_parcel->productWeight = $weight->value;
                $store_parcel->trackingCode = $tracking_code;
                $store_parcel->note = $request->note;
                $store_parcel->deliveryCharge = round($delivery_charge, 2);
                $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $store_parcel->codCharge = round($codcharge, 2);
                $store_parcel->division_id = $request->division_id;
                $store_parcel->district_id = $request->district_id;
                $store_parcel->thana_id = $request->thana_id;
                $store_parcel->area_id = $request->area_id;
                $store_parcel->delivery_address = $request->delivery_address;
                $store_parcel->productPrice = 0;
                $store_parcel->merchantAmount = $merchantAmount;
                $store_parcel->merchantDue = 0;
                $store_parcel->orderType = $deliveryChargeInfo->id;
                $store_parcel->codType = $deliveryChargeInfo->id;
                $store_parcel->status = 1;
                $store_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $store_parcel->id;
                $note->note = 'Parcel create successfully';
                $note->save();

                if ($store_parcel) {
                    $msg = 'Thanks! your parcel add successfully and your tracking code is : ' . $tracking_code;
                    return response()->json(['success' => true, 'message' => $msg], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method parcels
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function parcels(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $per_page = $request->per_page ?? 20;
        $user = $this->merchant($request->api_token);
        if ($user) {
            $parceltypes = Parceltype::all();
            if ($request->trackId != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.trackingCode', $request->trackId)
                    ->select('parcels.id','parcels.cod', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->select('parcels.id','parcels.cod', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.id','parcels.cod', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.id','parcels.cod', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } else {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->select('parcels.id','parcels.cod', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            }

            if ($request->parcel_type) {
                // $status = Parceltype::where('slug', $request->parcel_type)->first()->id??'';
                $allparcel->where('parcels.status', $request->parcel_type);
            }
            if($request->view_type) {
                $allparcel->whereDate('parcels.created_at', date('Y-m-d'));
            }
            if ($request->trackingCode) {
                $allparcel->where('parcels.trackingCode', $request->trackingCode);
            }

            $data = [
                'allparcel' => $allparcel->paginate($per_page),
                'parceltypes' => $parceltypes,
            ];

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    /**
     * Method parceldetails
     *
     * @param Request $request [explicite description]
     * @param $parcel_id $parcel_id [explicite description]
     *
     * @return void
     */
    public function parceldetails(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $parceldetails = DB::table('parcels')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->leftJoin('pickupmen', 'parcels.pickupmanId', '=', 'pickupmen.id')
                ->leftJoin('deliverymen', 'parcels.deliverymanId', '=', 'deliverymen.id')
                ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                ->where('merchantId', $user->id)
                ->where('parcels.id', '=', $parcel_id)
                ->select('parcels.id','parcels.created_at','parcels.updated_at', 'parcels.trackingCode','parcels.productWeight','parcels.cod','parcels.deliveryCharge','parcels.codCharge', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'pickupmen.name as pickupman_name', 'deliverymen.name as deliveryman_name', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
                ->first();


            $trackInfos = Parcelnote::where('parcelId', $parcel_id)->orderBy('id', 'ASC')->get();
            $data = [
                'parceldetails' => $parceldetails,
                'trackInfos' => $trackInfos
            ];
            return response()->json(['success' => true, 'data' => $parceldetails], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function invoice(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $show_data = DB::table('parcels')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('merchantId', $user->id)
                ->where('parcels.id', '=', $parcel_id)
                ->select('parcels.id', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
                ->first();
            $trackInfos = Parcelnote::where('parcelId', $parcel_id)->orderBy('id', 'ASC')->get();
            return response()->json(['success' => true, 'data' => $show_data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function parceledit(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = [
                'merchant' => $user,
                'weights' =>  Weight::where('status', 1)->get(),
                'delivery_charge_heads' => DeliveryChargeHead::where('status', 1)->get(),
                'parceledit' => Parcel::where(['merchantId' => $user->id, 'id' => $parcel_id])->first(),
                'divisions' => Division::orderBy('name')->orderBy('name')->where('status', 1)->get(),
            ];
            return response()->json(['success' => true, 'message' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }
    public function parcelupdate(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'hidden_id' => 'required',
            'phonenumber' => 'required|numeric|digits:11',
            'pickLocation' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $update_parcel = Parcel::find($request->hidden_id);
            $mercharntInfo = Merchant::where('id', $user->id)->first();
            $thana = Thana::find($update_parcel->thana_id);

            $inside_city = $mercharntInfo->inside_city ?? 0;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana->id)->get();


            // get subcity list
            $sub_city = $mercharntInfo->sub_city ?? 0;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana->id)->get();

            // get outside list
            $district_id = $request->district_id;
            $outside_city = $mercharntInfo->outside_city ?? 0;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


            $excluded_weights = [];
            $excluded_weights_last_id = 1;

            if (count($get_packages_inside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
                // return $excluded_weights_last_id;
            }
            if (count($get_packages_sub_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_outside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }

            $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
            $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

            $last_extra_weight = $weight_last_value->extra_weight;




            if (empty($thana->deliverycharge_id)) {
                return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
            }



            if (!empty($last_extra_weight)) {

                $percelType = 1;
                if ($request->productPrice > 0) {
                    $percelType = 2;  // COD Collection
                }
                $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

                // return $delivery_charge;
                // Extra charge
                $extra_weight = $weight->value + 0.5;
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

                // die();
                // Promotional Charge
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }
                $delivery_charge = $delivery_charge - $promotiuonal_discount;

                // cod charge
                // $codChargeInfo = Codcharge::where(['status' => 1])->first();
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->cod) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

                // inside city packages
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                        // return $delivery_charge;
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }

                // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }

                // outside city package
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }



                $merchantAmount = (round($update_parcel->cod - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);

                // Update parcel
                // $update_parcel->invoiceNo = $request->invoiceno;
                $update_parcel->merchantId = $mercharntInfo->id;
                $update_parcel->cod = $update_parcel->cod;
                $update_parcel->invoiceNo = $request->invoiceNo;
                $update_parcel->percelType = $percelType;
                $update_parcel->recipientName = $request->name;
                $update_parcel->recipientAddress = $request->delivery_address;
                $update_parcel->recipientPhone = $request->phonenumber;
                $update_parcel->alternative_mobile_no = $request->alternative_mobile_no;
                $update_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $update_parcel->pickLocation = $mercharntInfo->pickLocation;
                $update_parcel->productWeight = $weight->value;
                $update_parcel->note = $request->note;
                $update_parcel->deliveryCharge = $delivery_charge;
                // $update_parcel->deliveryCharge = $request->deliveryCharge;
                $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $update_parcel->codCharge = round($codcharge, 2);
                $update_parcel->division_id = $request->division_id;
                $update_parcel->district_id = $request->district_id;
                $update_parcel->thana_id = $request->thana_id;
                $update_parcel->area_id = $request->area_id;
                $update_parcel->delivery_address = $request->delivery_address;
                $update_parcel->productPrice = 0;
                $update_parcel->cod = $request->cod;
                $update_parcel->merchantAmount = $merchantAmount;
                $update_parcel->merchantDue = 0;
                $update_parcel->orderType = $deliveryChargeInfo->id;
                $update_parcel->codType = $deliveryChargeInfo->id;
                $update_parcel->status = 1;
                $update_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $update_parcel->id;
                $note->note = 'Parcel updated successfully';
                $note->save();

                if ($update_parcel) {
                    $msg = 'Thanks! your parcel update successfully';

                    return response()->json(['success' => true, 'message' => $msg], 200);
                }
            } else {


                $percelType = 1;
                if ($request->productPrice > 0) {
                    $percelType = 2;  // COD Collection
                }


                // get deliverycharge   
                $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

                // Extra charge
                $extra_weight = $weight->value - 0.5;

                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);
                // Promotional Charge
                $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                    ->whereDate('end_date', '>=', date('Y-m-d'))
                    ->where('status', 1)->first();
                if ($promotiuonal_discount_exist) {
                    $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
                } else {
                    $promotiuonal_discount = 0;
                }

                $delivery_charge = $delivery_charge - $promotiuonal_discount;
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->cod) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


                // return $get_packages_sub_city;
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }

                // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }

                // outside city package
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->cod * $package->cod_charge) / 100;
                }


                $merchantAmount = (round($update_parcel->cod - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);


                // Update parcel
                $update_parcel->merchantId = $mercharntInfo->id;
                $update_parcel->cod = $update_parcel->cod;
                $update_parcel->invoiceNo = $request->invoiceNo;
                $update_parcel->percelType = $percelType;
                $update_parcel->recipientName = $request->name;
                $update_parcel->recipientAddress = $request->delivery_address;
                $update_parcel->recipientPhone = $request->phonenumber;
                $update_parcel->alternative_mobile_no = $request->alternative_mobile_no;
                $update_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $update_parcel->pickLocation = $mercharntInfo->pickLocation;
                $update_parcel->productWeight = $weight->value;
                $update_parcel->note = $request->note;
                $update_parcel->deliveryCharge = $delivery_charge;
                $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $update_parcel->codCharge = round($codcharge, 2);
                $update_parcel->division_id = $request->division_id;
                $update_parcel->district_id = $request->district_id;
                $update_parcel->thana_id = $request->thana_id;
                $update_parcel->area_id = $request->area_id;
                $update_parcel->delivery_address = $request->delivery_address;
                $update_parcel->productPrice = 0;
                $update_parcel->cod = $request->cod;
                $update_parcel->merchantAmount = $merchantAmount;
                $update_parcel->merchantDue = 0;
                $update_parcel->orderType = $deliveryChargeInfo->id;
                $update_parcel->codType = $deliveryChargeInfo->id;
                $update_parcel->status = 1;
                $update_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $update_parcel->id;
                $note->note = 'Parcel updated successfully';
                $note->save();

                if ($update_parcel) {
                    $msg = 'Thanks! your parcel update successfully';

                    return response()->json(['success' => true, 'message' => $msg], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function singleservice(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'contact_mail' => 'support@deliveryjhotpot.com',
            'address' => $request->address,
            'area' => $request->area,
            'note' => $request->note,
            'estimate' => $request->estimate,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = array(
                'contact_mail' => 'info@sensorbd.com',
                'address' => $request->address,
                'area' => $request->area,
                'note' => $request->note,
                'estimate' => $request->estimate,
            );
            $send = Mail::send('frontEnd.emails.singleservice', $data, function ($textmsg) use ($data) {
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('A Single Service Request');
            });

            $msg = 'Thanks! your  request send successfully';
            return response()->json(['success' => true, 'message' => $msg], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function payments(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $per_page = $request->per_page ?? 20;

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = Merchantpayment::where('merchantId', $user->id)->paginate($per_page);
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function inovicedetails(Request $request, $merchantpayment_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = [
                'inovicedetails' => Merchantpayment::find($merchantpayment_id),
                'invoiceInfo' => Parcel::where('paymentInvoice', $merchantpayment_id)->get()
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function passfromreset(Request $request)
    {
        $rules = [
            'phoneNumber' => 'required'
        ];
        $setting = Setting::first();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $validMerchant = Merchant::Where('phoneNumber', $request->phoneNumber)->first();
        if ($validMerchant) {
            $verifyToken = rand(111111, 999999);
            $validMerchant->passwordReset     =    $verifyToken;
            $validMerchant->save();
            $msg = "Dear $validMerchant->firstName, \r\n Your password reset token is $verifyToken. Enjoy our services. If any query call us $setting->mobile_no \r\nRegards\r\n $setting->name ";
            $numbers = "0" . $validMerchant->phoneNumber;
            $send_sms = $this->sendOTPSMS($numbers, $msg);
            return response()->json(['success' => true, 'message' => 'Your password reset token send successfully done.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! You have no account'], 200);
        }
    }

    public function saveResetPassword(Request $request)
    {
        $rules = [
            'phoneNumber' => 'required',
            'verifyPin' => 'required',
            'newPassword' => 'required'
        ];

        $validMerchant = Merchant::where('phoneNumber', $request->phoneNumber)->first();
        if ($validMerchant->passwordReset == $request->verifyPin) {
            $validMerchant->password     =    bcrypt(request('newPassword'));
            $validMerchant->passwordReset     =    NULL;
            $validMerchant->save();
            return response()->json(['success' => true, 'message' => 'Wow! Your password reset successfully.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid reset code !'], 200);
        }
    }

    public function parceltrack(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'trackid' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->merchant($request->api_token);
        if ($user) {
            $trackparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.trackingCode', $request->trackid)
                ->select('parcels.id', 'parcels.created_at', 'parcels.trackingCode', 'parcels.status', 'parcels.recipientName', 'parcels.recipientPhone', 'parcels.recipientAddress', 'parcels.note', 'parcels.status', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->first();
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();

            $data = [
                'trackparcel' => $trackparcel,
                'trackInfos' => $trackInfos
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }

    public function parcelTypes(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = Parceltype::all();
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
    }
}
