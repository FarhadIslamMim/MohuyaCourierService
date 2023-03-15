<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AgentThana;
use App\Models\Deliveryman;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\Pickup;
use App\Models\Pickupman;
use App\Models\PickupmanAgent;
use App\Models\PickupmanPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use illuminate\support\str;

class PickupmanApiController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'pickupman_user' => 'required',
            'pickupman_password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $checkAuth = Pickupman::with('area')->where('email', $request->pickupman_user)
            ->orWhere('phone', $request->pickupman_user)
            ->first();

        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                return response()->json(['success' => false, 'message' => 'Opps! your account has been suspends'], 200);
            } else {
                if (password_verify($request->pickupman_password, $checkAuth->password)) {
                    return response()->json(['success' => true, 'data' => $checkAuth, 'message' => 'Thanks , You are login successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Sorry! your password wrong'], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! you have no account'], 200);
        }
    }

    public function parcelTypes(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $data = Parceltype::whereIn('id',[1,2])->get();
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function dashboard(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $data = [
                 //today
                'today_parcel'=> Parcel::where(['pickupmanId' => $user->id])->whereDate('updated_at', Carbon::today()->toDateString())->count(),
                'today_pending' => Parcel::where(['pickupmanId' =>  $user->id,  'status' => 1])->whereDate('updated_at', Carbon::today()->toDateString())->count(),
                 'today_picked' => Parcel::where(['pickupmanId' =>  $user->id,  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->count(),
                'today_amount' => Parcel::where(['pickupmanId' => $user->id])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_amount'),
                'today_paid' => Parcel::where(['pickupmanId' => $user->id])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_paid'),
                'today_unpaid' => Parcel::where(['pickupmanId' => $user->id])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_due'),

                //total
                'total_parcel' => Parcel::where(['pickupmanId' => $user->id])->count(),
                'total_pending' => Parcel::where(['pickupmanId' => $user->id, 'status' => 1])->count(),
                'total_picked' => parcel::where(['pickupmanId' => $user->id])->whereNotIn('status', [1,4])->count(),
                'total_delivered' => Parcel::where(['pickupmanId' => $user->id, 'status' => 4])->count(),
                'total_amount' => Parcel::where(['pickupmanId' => $user->id])->sum('pickupman_amount'),
                'total_paid' => Parcel::where(['pickupmanId' => $user->id])->sum('pickupman_paid'),
                'total_due' => Parcel::where(['pickupmanId' => $user->id])->sum('pickupman_due'),
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parcels(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $data = [];
            $filter = $request->filter_id;
            $per_page = $request->per_page ?? 20;
            $parcel_types = Parceltype::all();
            if ($request->trackId != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.pickupmanId', $user->id)
                    ->where('parcels.trackingCode', $request->trackId)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.pickupmanId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.pickupmanId', $user->id)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.pickupmanId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } else {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->orWhere('parcels.pickupmanId', $user->id)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            }

            if ($request->parcel_type) {
                $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
                $data['all_parcel'] = $data['all_parcel']->where('parcels.status', '=', $request->parcel_type);
            }
            if ($request->view_type) {
                if($request->view_type == 1) {
                    $data['all_parcel'] = $data['all_parcel']->whereDate('parcels.updated_at', date('Y-m-d'));
                }
            }
            $data['all_parcel'] = $data['all_parcel']->paginate($per_page);

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function getMerchants(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $merchants = Merchant::where('status', 1)->verify()->get();
            return response()->json(['success' => true, 'data' => $merchants], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function multipickupParcels(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $data = [];
            $per_page = $request->per_page ?? 20;
            if ($request->merchant_id) {
                $query = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $request->merchant_id)
                    ->where('parcels.pickupmanId', $user->id)
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');

                if ($request->parcel_type) {
                    $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
                    $query->where('parcels.status', '=', $request->parcel_type);
                }
                $data['all_parcel'] = $query->paginate($per_page);
            }
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function multipleParcelPicked(Request $request)
    {
        $rules = [
            'parcel_select' => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->pickupman($request->api_token);
        if ($user) {
            $total_parcel = 0;
            $tracking_codes = '';

            foreach ($request->parcel_select ?? [] as $parcel_id) {
                $parcel = Parcel::find($parcel_id);
                $merchantinfo = Merchant::find($parcel->merchantId);
                $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

                if ($parcel) {
                    $parcel->pickup_date = now();
                    if ($pickupmanInfo) {
                        $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                        $parcel->pickupman_paid = 0;
                        $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                    }

                    $parcel->status = 2;
                    $parcel->save();

                    $note = new Parcelnote();
                    $note->parcelId = $parcel_id;
                    $note->note = "Your parcel PICKED";
                    $note->save();

                    // Send Customer Message
                    if ($parcel->recipientPhone) {
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n Sensor Courier ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }

                    $total_parcel += 1;
                    $tracking_codes .= $parcel->trackingCode . ',';
                }
            }
            $numbers = "0" . $merchantinfo->phoneNumber;
            $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $tracking_codes are PICKED.
                        Regards,
                        Sensor Courier";
            $this->sendSMS($numbers, $msg);

            return response()->json(['success' => true, 'message' => $total_parcel . ' parcel picked successfully done.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function pendingParcels(Request $request)
    {
        $data = [];
        $filter = $request->filter_id;
        $per_page = $request->per_page ?? 20;
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $agent_ids = PickupmanAgent::where('pickupman_id', $user->id)->pluck('agent_id');
            $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');
            $filter = $request->filter_id;
            if ($request->trackId != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.pickupmanId')
                    ->where('parcels.trackingCode', $request->trackId)
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->phoneNumber != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.pickupmanId')
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.pickupmanId')
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.pickupmanId')
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } else {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.pickupmanId')
                    ->where('parcels.status', 1)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            }

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function pickupmanAsign(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'pickupmanId' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->pickupman($request->api_token);
        if ($user) {
            $parcel = Parcel::find($request->hidden_id);
            $parcel->pickupmanId = $request->pickupmanId;
            $parcel->save();

            $note = new Parcelnote();
            $note->parcelId = $request->hidden_id;
            $note->note = "pickupman Asign";
            $note->save();
            return response()->json(['success' => true, 'message' => 'A pickupman asign successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function invoice(Request $request, $id)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $data = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                ->where('parcels.id', $id)
                ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->first();
            if ($data) {
                return response()->json(['success' => true, 'data' => $data], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Opps! Parcel not found.'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function statusupdate(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $parcel = Parcel::find($request->hidden_id);
            $parcel->status = $request->status;
            $parcel->save();

            if ($request->note) {
                $note = new Parcelnote();
                $note->parcelId = $request->hidden_id;
                $note->note = $request->note;
                $note->save();
            }
            if ($request->status == 2) {


                $parcel->status = $request->status;
                $parcel->pickupman_amount = $user->per_parcel_amount;
                $parcel->pickupman_paid = 0;
                $parcel->pickupman_due = $user->per_parcel_amount;
                $parcel->pickup_date = now();
                $parcel->save();


                $merchantinfo = Merchant::find($parcel->merchantId);
                if ($user != NULL) {
                    $number = "0" . $merchantinfo->phoneNumber;
                    $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID " . $parcel->trackingCode . " for " . $user->name . " , " . $user->phone . " is PICKED.
                     Regards, Sensor Courier";
                    $this->sendSMS($number, $msg);
                }
                if ($request->note != NULL) {
                    $note = new Parcelnote();
                    $note->parcelId = $request->hidden_id;
                    $note->note = 'Parcel Picked successfully';
                    $note->save();
                }
            } elseif ($request->status == 3) {
                $parcel = Parcel::find($request->hidden_id);
                $parcel->status = $request->status;
                $parcel->save();
                $parcel->merchantDue = 0;
                $parcel->save();
            } elseif ($request->status == 4) {
                $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
                $parcel = Parcel::find($request->hidden_id);
                $parcel->status = $request->status;
                $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                $parcel->deliveryman_paid = 0;
                $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
                $parcel->delivery_date = now();
                $parcel->save();

                if ($request->note != NULL) {
                    $note = new Parcelnote();
                    $note->parcelId = $request->hidden_id;
                    $note->note = 'Parcel delivered successfully';
                    $note->save();
                }
                $merchantinfo = Merchant::find($parcel->merchantId);
                if ($merchantinfo != NULL) {
                    $number = "0" . $merchantinfo->phoneNumber;
                    $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID " . $parcel->trackingCode . " for " . $deliverymanInfo->name . " , " . $deliverymanInfo->phone . " is DELIVERED.
                     Regards, Sensor Courier";
                    $this->sendSMS($number, $msg);
                }
                // if ($merchantinfo->emailAddress) {
                //     $data = array(
                //         'contact_mail' => $merchantinfo->emailAddress,
                //         'trackingCode' => $parcel->trackingCode,
                //     );
                //     $send = Mail::send('frontEnd.emails.percelcancel', $data, function ($textmsg) use ($data) {
                //         $textmsg->from('info@sensorbd.com');
                //         $textmsg->to($data['contact_mail']);
                //         $textmsg->subject('Percel Cancelled Notification');
                //     });
                // }

            }

            return response()->json(['success' => true, 'message' => 'Parcel information update successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function pickup(Request $request)
    {
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $show_data = DB::table('pickups')
                ->where('pickups.pickupman', $user->id)
                ->orderBy('pickups.id', 'DESC')
                ->select('pickups.*')
                ->get();
            $deliverymens = Pickupman::where('status', 1)->get();
            return response()->json(['success' => true, 'data' => $show_data, 'deliverymens' => $deliverymens], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function pickupdeliverman(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'pickupman' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $pickup = Pickup::find($request->hidden_id);
            $pickup->pickupman = $request->pickupman;
            $pickup->save();
            return response()->json(['success' => true, 'message' => 'A pickupman asign successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function pickupstatus(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->pickupman($request->api_token);
        if ($user) {
            $pickup = Pickup::find($request->hidden_id);
            $pickup->status = $request->status;
            $pickup->save();
            return response()->json(['success' => true, 'message' => 'Pickup status update successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function locationUpdate(Request $request)
    {
        $rules = [
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->pickupman($request->api_token);
        if ($user) {
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->location = $request->location;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Location updated successfully done.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function passfromreset(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $validpickupman = pickupman::Where('email', $request->email)->first();
        if ($validpickupman) {
            $verifyToken = rand(111111, 999999);
            $validpickupman->passwordReset  = $verifyToken;
            $validpickupman->save();

            $data = array(
                'contact_mail' => $validpickupman->email,
                'verifyToken' => $verifyToken,
            );
            $send = Mail::send('frontEnd.layouts.pages.pickupman.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });
            return response()->json(['success' => true, 'data' => $validpickupman, 'message' => 'Forget password token send to your mail successfully.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! You have no account'], 200);
        }
    }
    public function saveResetPassword(Request $request)
    {
        $rules = [
            'verifyPin' => 'required',
            'pickupman_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Opps, User id not found!'], 200);
        }

        $validpickupman = pickupman::find($request->pickupman_id);
        if ($validpickupman->passwordReset == $request->verifyPin) {
            $validpickupman->password   = bcrypt(request('newPassword'));
            $validpickupman->passwordReset  = NULL;
            $validpickupman->save();

            return response()->json(['success' => true, 'data' => $validpickupman, 'true' => 'Wow! Your password reset successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! Your process something wrong', 'warning!'], 200);
        }
    }

    public function logout(Request $request)
    {
        $rules = [
            'pickupman_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Opps, Logged user not found!'], 200);
        }
        $pickupman = Pickupman::find($request->pickupman_id);
        if ($pickupman) {
            $pickupman->api_token = Str::random(60);
            $pickupman->save();
            return response()->json(['success' => true, 'message' => 'Thanks! you are logout successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! user not found!'], 200);
        }
    }

    public function payments(Request $request, $type = 'all')
    {
        $rules = [
            'api_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $pickupman = $this->pickupman($request->api_token);
        if ($pickupman) {
            $query = Parcel::where('pickupmanId', $pickupman->id);
            if ($type == 'paid') {
                $query->where('pickupman_paid', '>', 0);
            }
            if ($type == 'due') {
                $query->where('pickupman_due', '>', 0);
            }
            $data = $query->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(15);
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! user not found!'], 200);
        }
    }

    // inovicedetails
    public function inovicedetails(Request $request, $pickupman_id)
    {
         //return $request->all();
        // $rules = [
        //     'api_token' => 'required',
        // ];

        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        // }
        // $user = $this->pickupman($request->api_token);
        // if ($user) {
        //     $data = [
        //         'inovicedetails' => PickupmanPayment::find($pickupman_id),
        //         'invoiceInfo' => Parcel::where('pickupman_payment_invoice', $pickupman_id)->get()
        //     ];
        //     return response()->json(['success' => true, 'data' => $data], 200);
        // } else {
        //     return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        // }
        
        
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->pickupman($request->api_token);
        if ($user) {
            
            $results = Parcel::where('pickupman_payment_invoice', $pickupman_id)->get();
            if($results) {
                $results->map(function($i) use($results) {
                    $i->cmp_name = $i->merchant->companyName;
                });
            }
            $amounts =  $results->sum('pickupman_paid', 2);
            $pickupman_details =  $user;
            //$site_settings =  Setting::first();
            
            $data = [
                'parcels' => $results,
                'inv_total' => $amounts,
                'dman' => $pickupman_details,
                //'pay_from' => $site_settings,
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
        }
        
    }
    
   public function paymentInvoices(Request $request)
    {
        
            $rules = [
                'api_token' => 'required',
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
            }
            $user = $this->pickupman($request->api_token);
            if ($user) {
                if ($request->start_date != null && $request->end_date != null){
                    $invoices = PickupmanPayment::where('pickupman_id', $user->id)->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->paginate(15);
                }elseif ($request->start_date !=null){
                    $invoices = PickupmanPayment::where('pickupman_id', $user->id)->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->paginate(15);
                }elseif ($request->end_date !=null){
                    $invoices = PickupmanPayment::where('pickupman_id', $user->id)->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->paginate(15);
                }else{
                    $invoices = PickupmanPayment::where('pickupman_id', $user->id)->latest()->paginate(15);
                }
                
                return response()->json(['success' => true, 'data' => $invoices], 200);
                
                
            } else {
                return response()->json(['success' => false, 'message' => 'Opps! Invalid API token.'], 200);
            }

            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);

    }
}
