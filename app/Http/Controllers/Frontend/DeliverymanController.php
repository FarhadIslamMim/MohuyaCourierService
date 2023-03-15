<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AgentThana;
use App\Models\Deliveryman;
use App\Models\DeliverymanAgent;
use App\Models\DeliverymanExtraWeight;
use App\Models\DeliverymanPayment;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\Pickupman;
use App\Models\Setting;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DeliverymanController extends Controller
{
    //
    public function dashboard()
    {
        // Daily parcel details
        $dailyparcel = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypending = Parcel::where(['deliverymanId' => Session::get('deliverymanId'),  'status' => 1])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypicked = Parcel::where(['deliverymanId' => Session::get('deliverymanId'),  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyintransit = Parcel::where(['deliverymanId' => Session::get('deliverymanId'),  'status' => 3])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyhold = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 5])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $daily_partial_return = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->select('partial_return_amount')->whereDate('updated_at', Carbon::today())->sum('partial_return_amount');
        $dailydelivered = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 4])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturnpending = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 6])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntohub = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 7])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntomarchant = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 8])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailycancled = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 9])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $today_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('deliveryman_amount');
        $today_paid = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('deliveryman_paid');
        $today_unpaid = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('deliveryman_due');
        $totalparcel = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereIn('status', [1, 2, 3, 4, 5, 6, 7, 9])->count();
        $totalpending = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 1])->count();
        $totalpicked = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 2])->count();
        $totaltransit = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 3])->count();
        $totaldelivery = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 5])->count();
        $totalcancel = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 9])->count();
        $returnpendin = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 8])->count();
        $returnhub = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 7])->count();
        $total_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_amount');
        $total_paid = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_paid');
        $total_due = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_due');
        $deliveryman_info = Deliveryman::where('id', Session::get('deliverymanId'))->select('name')->first();
        $total_partial_return_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->select('partial_return_amount')->sum('partial_return_amount');
        $today_collected_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->whereDate('updated_at', Carbon::today())->sum('collected_amount');
        $collected_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('collected_amount');
        $today_picked_amount = Parcel::whereDate('created_at', Carbon::today())->where('deliverymanId', Session::get('deliverymanId'))->where('status', '2')->sum('cod');
        $today_transit_amount = Parcel::whereDate('created_at', Carbon::today())->where('deliverymanId', Session::get('deliverymanId'))->where('status', '3')->sum('cod');

        return view('frontend.pages.deliveryman.dashboard.home', compact(
            'totaltransit',
           'totalpicked',
            'totalpending',
            'totalparcel',
            'totaldelivery',
            'totalhold',
            'totalcancel',
            'returnpendin',
            'returnmerchant',
            'total_amount',
            'returnhub',
            'total_paid',
            'total_due',
            'dailyparcel',
            'dailypending',
            'dailypicked',
            'dailyhold',
            'dailydelivered',
            'dailyreturnpending',
            'dailyreturntohub',
            'dailyreturntomarchant',
            'dailycancled',
            'deliveryman_info',
            'dailyintransit',
            'daily_partial_return',
            'today_amount',
            'today_paid',
            'today_unpaid',
            'today_collected_amount',
            'collected_amount',
            'today_picked_amount',
            'today_transit_amount',
            'total_partial_return_amount'
        ));
    }


    // All Parcel
    public function parcels(Request $request)
    {
//        $filter = $request->filter_id;
        if ($request->trackId != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        }elseif ($request->startDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->startDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();

        }
        elseif ($request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();

        } elseif ($request->phoneNumber != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'desc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->orWhere('parcels.deliverymanId', Session::get('deliverymanId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
//                ->orderBy('parcels.status', 'desc')->orderBy('parcels.id', 'desc')
                ->latest()->get();
        }
        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        $parceltypes = Parceltype::all();

        return view('frontend.pages.deliveryman.percel.allpercels', compact('allparcel', 'parceltypes'));
    }




    // parcels pending
    public function pendingParcels(Request $request)
    {
    }

    //today parcel
    // todays percel list
    public function todaysPercel(Request $request)
    {
        $filter = $request->filter_id;
        if ($request->trackId != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')->orderBy('parcels.id', 'desc')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereBetween('parcels.updated_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } elseif($request->startDate != null){
            $allparcel = DB::table('parcels')->orderBy('parcels.id', 'desc')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereDate('parcels.updated_at', [Carbon::parse($request->startDate)->startOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        }elseif($request->endDate != null){
            $allparcel = DB::table('parcels')->orderBy('parcels.id', 'desc')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->whereDate('parcels.updated_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        }elseif ($request->trackId != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.updated_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->whereDate('parcels.updated_at', Carbon::today())
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'ASC')
                ->orderBy('created_at','ASC')->get();
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        $parceltypes = Parceltype::all();

        return view('frontend.pages.deliveryman.percel.todayparcel', compact('allparcel', 'parceltypes'));
    }

    // update status
    public function statusupdate(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'status' => 'required',
        ]);

        $parcel = Parcel::find($request->hidden_id);
        $merchantinfo = Merchant::find($parcel->merchantId);
        $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
        $pickupmanInfo = Pickupman::where(['id' => $parcel->deliverymanId])->first();

        if ($request->status == 1) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->status == 2) {
            $parcel->pickup_date = now();
            if ($pickupmanInfo) {
                $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                $parcel->pickupman_paid = 0;
                $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                $parcel->save();
            }

            if ($pickupmanInfo != null) {
                // Sens Merchant message
                $numbers = '0' . $merchantinfo->phoneNumber;
                $msg = 'Dear ' . $merchantinfo->companyName . ", Your Parcel Tracking ID $parcel->trackingCode for $pickupmanInfo->name , $pickupmanInfo->phone is PICKED.
                        Regards,
                        Stepup Courier";
                $this->sendSMS($numbers, $msg);
            }
            if ($parcel->recipientPhone) {
                $msg = 'Dear ' . $parcel->recipientName . ", Your Parcel Tracking ID $parcel->trackingCode is PICKED.
                        Regards,
                        Stepup Courier";
                $this->sendSMS($parcel->recipientPhone, $msg);
            }
        } elseif ($request->status == 3) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->status == 4) {


            $inside_city = $merchantinfo->inside_city;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $parcel->thana_id)->get();


            // get subcity list
            $sub_city = $merchantinfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $parcel->thana_id)->get();

            // get outside list
            $district_id = $request->district_id;
            $outside_city = $merchantinfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $parcel->district_id)->get();
            $parcel->merchantAmount = ($request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge);

            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
            $parcel->merchantDue = $parcel->merchantAmount;

            if ($get_packages_inside_city) {
                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                $parcel->save();
            }

            if ($get_packages_sub_city) {


                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                $parcel->save();
            }

            if ($get_packages_outside_city) {
                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                $parcel->save();
            }

            $parcel->delivery_date = now();
            if ($deliverymanInfo) {
               $parcel_weight =  $parcel->productWeight;
               $d_max_weight = $deliverymanInfo->max_weight;
               if ($parcel_weight > $d_max_weight ){
                   $extra_weight = $parcel_weight - $d_max_weight;
                   $parcel->deliveryman_amount =  ($extra_weight * $deliverymanInfo->extra_weight_charge ) + $deliverymanInfo->per_parcel_amount;
                   $parcel->deliveryman_paid = 0;
                   $parcel->deliveryman_due =  ($extra_weight * $deliverymanInfo->extra_weight_charge ) + $deliverymanInfo->per_parcel_amount;
               }else{
                   $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                   $parcel->deliveryman_paid = 0;
                   $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
               }
            }
            $parcel->collected_amount = $request->collected_amount;
            $parcel->deliveryman_note = $request->deliveryman_note;
            $parcel->save();
            $validMerchant = Merchant::find($parcel->merchantId);

            // Sens Merchant message
            $numbers = '0' . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Stepup Courier";
            $this->sendSMS($numbers, $msg);

            // Send Customer message
            $customer_numbers = $parcel->recipientPhone;
            $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Stepup Courier ";
            $this->sendSMS($customer_numbers, $customer_msg);
        } elseif ($request->status == 5) {

            if ($deliverymanInfo) {
                // Send Customer message
                $customer_numbers = $parcel->recipientPhone;
                $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n Stepup Courier ";
                $this->sendSMS($customer_numbers, $customer_msg);
            }
        } elseif ($request->status == 9) {
            if ($parcel->status < 2) {
                $parcel->cod = 0;
                $parcel->merchantAmount = 0;
                $parcel->merchantDue = 0;
                $parcel->deliveryCharge = 0;
                $parcel->codCharge = 0;
            }
        } else {
            // $parcel->cod = 0;
            // $parcel->codCharge = 0;
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);

            $validMerchant = Merchant::find($parcel->merchantId);
            // Send Merchant message
            $numbers = '0' . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is RETURN. \r\n Regards,\r\n Stepup Courier";
            $this->sendSMS($numbers, $msg);
        }

        $parcel->status = $request->status;
        $parcel->deliveryman_note = $request->deliveryman_note;
        $parcel->save();

        $pnote = Parceltype::find($request->status);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = 'Your parcel ' . $pnote->title;
        $note->save();

        return redirect()->back()->with('success', 'Parcel information updated');
    }

    // partial return
    public function partialReturn(Request $request)
    {
        $this->validate($request, [
            'parcel_id' => 'required',
            'partial_return_amount' => 'required|numeric',
        ]);
        $parcel = Parcel::find($request->parcel_id);
        $old_amount = $parcel->partial_return_amount ?? 0;
        $parcel->partial_return_amount = $old_amount + $request->partial_return_amount;
        $parcel->partial_return_note = $request->partial_return_note;
        $parcel->merchantAmount = $parcel->cod - ($parcel->deliveryCharge + $parcel->codCharge + $parcel->partial_return_amount);
        $parcel->save();

        return back()->with('success', 'Partial return successfully!');
    }

    // assignable
    public function assignable(Request $request)
    {
        $deliveryman = Deliveryman::find(Session::get('deliverymanId'));

        $agent_ids = DeliverymanAgent::where('deliveryman_id', Session::get('deliverymanId'))->pluck('agent_id');
        // return $agent_ids;

        $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');

        // return $thana_ids;


        $parceltypes = Parceltype::all();
        $filter = $request->filter_id;
        if ($request->trackId != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
//                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        }elseif ($request->startDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
//                ->whereDate('parcels.created_at', [$request->startDate])
                ->whereDate('parcels.created_at', [Carbon::parse($request->startDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        }elseif ($request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
//                ->whereDate('parcels.created_at', [$request->endDate])
                ->whereDate('parcels.created_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->phoneNumber != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
//                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
//                ->orderBy('parcels.id', 'desc')
                ->latest()->get();
        }

        // return $allparcel;

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }
        Session::put('parcel_count', count($allparcel));

        return view('frontend.pages.deliveryman.percel.assignable', compact('allparcel', 'parceltypes'));
    }

    //  assignme
    public function assignme(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'deliverymanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->deliverymanId = $request->deliverymanId;
        $parcel->save();

        $deliveryman = Deliveryman::find($request->deliverymanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Deliveryman Asign";
        $note->remark = $deliveryman->name . ' - ' . $deliveryman->phone;
        $note->save();
        return redirect()->back()->with('success', 'deliveryman asign successfully');
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        if ($merchantinfo->emailAddress) {
            $data = array(
                'contact_mail' => $merchantinfo->emailAddress,
                'ridername' => $deliverymanInfo->name,
                'riderphone' => $deliverymanInfo->phone,
                'codprice' => $parcel->cod,
                'trackingCode' => $parcel->trackingCode,
            );
            $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Percel Assign Notification');
            });
        }
    }



    public function paymentInvoices(Request $request)
    {
        if ($request->start_date != null && $request->end_date != null){
            $invoices = DeliverymanPayment::where('deliveryman_id', Session::get('deliverymanId'))->with('getPercelDetails', 'geDeatilsDeliveryman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = DeliverymanPayment::where('deliveryman_id', Session::get('deliverymanId'))->with('getPercelDetails', 'geDeatilsDeliveryman')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = DeliverymanPayment::where('deliveryman_id', Session::get('deliverymanId'))->with('getPercelDetails', 'geDeatilsDeliveryman')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }else{
            $invoices = DeliverymanPayment::where('deliveryman_id', Session::get('deliverymanId'))->with('getPercelDetails', 'geDeatilsDeliveryman')->latest()->get();
        }
        return view('frontend.pages.deliveryman.payments.delivery_payment_invoice_list', compact('invoices'));
    }


    public function paymentInvoiceDetails($id)
    {
        $results = Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'merchant')->get();
        $amounts =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $deliveryman_details =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'parcelStatus')->first();
        $site_settings =  Setting::first();

        return view('frontend.pages.deliveryman.payments.delivery_payment_invoice', compact('results', 'amounts', 'deliveryman_details', 'site_settings'));
    }

    public function paymentInvoiceDownload($id)
    {
        $results =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'merchant')->get();
        $amounts =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $deliveryman_details =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'parcelStatus')->first();
        $site_settings = Setting::first();

        $config = ['instanceConfigurator' => function ($mpdf) {
            $mpdf->SetWatermarkText('Sensor');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.05;
        }];
        $data = [
            'results' => $results,
            'amounts' => $amounts,
            'deliveryman_details' => $deliveryman_details,
            'site_settings' => $site_settings,
        ];
        $pdf = PDF::loadHtml(view('frontend.pages.deliveryman.payments.delivery_payment_invoice', $data), $config);
        $name = $deliveryman_details->updated_at->format('d M Y g:i:s');
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');
    }



    public function profile()
    {
        $id = Session::get('deliverymanId');
        $deliveryman = Deliveryman::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::select('id', 'name')->get();
        $agent_id = DeliverymanAgent::where('deliveryman_id', $id)->pluck('agent_id')->toArray();
        $area_id = Deliveryman::where('id', $id)->pluck('area_id')->toArray();

        return view('frontend.pages.deliveryman.percel.profile', compact('deliveryman', 'divisions', 'agent_id', 'area_id', 'districts'));
    }



    /**
     * Method locationUpdate
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function locationUpdate(Request $request)
    {

        $deliveryman_location = Deliveryman::find(Session::get('deliverymanId'));

        //   return $deliveryman_location;
        $deliveryman_location->latitude = $request->latitude;
        $deliveryman_location->longitude = $request->longitude;
        // $deliveryman_location->location = $request->regionName;
        $deliveryman_location->save();

        if ($deliveryman_location) {
            return "Current Location updated";
        } else {
            return "Couldn't update the location";
        }
    }
}
