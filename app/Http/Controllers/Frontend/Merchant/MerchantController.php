<?php

namespace App\Http\Controllers\Frontend\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use App\Models\Merchant;
use App\Models\Merchantpayment;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\PromotionalDiscount;
use App\Models\Setting;
use App\Models\Thana;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MerchantController extends Controller
{

    public function index()
    {
        $returnDelCharge = DB::table('parcels')->where([
            ['merchantId', '=', Session::get('merchantId')],
            ['status', '>', '5'],
            ['status', '<', '9'],
        ])->sum('deliveryCharge');


        $return_charge = DB::table('parcels')->where([
            ['merchantId', '=', Session::get('merchantId')],
            ['status', '>', '5'],
            ['status', '<', '9'],
        ])->sum('return_charge');

        $today_returnDelCharge = DB::table('parcels')->where([
            ['merchantId', '=', Session::get('merchantId')],
            ['status', '>', '5'],
            ['status', '<', '9'],
        ])->whereDate('created_at', Carbon::today())->sum('deliveryCharge');



        $prepDelAmount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4, 'percelType' => 1])->sum('deliveryCharge');
        $today_prepDelAmount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4, 'percelType' => 1])->whereDate('created_at', Carbon::today())->sum('deliveryCharge');

        $allPaidParcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'merchantpayStatus' => 1])->get();

        $today_allPaidParcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'merchantpayStatus' => 1])->whereDate('created_at', Carbon::today())->get();

         $placepercel = Parcel::where(['merchantId' => Session::get('merchantId')])->count();
         $placepercel_amount = Parcel::where(['merchantId' => Session::get('merchantId')])->sum('cod');
        $today_parcel_total = Parcel::where(['merchantId' => Session::get('merchantId')])->whereDate('created_at', Carbon::today())->sum('cod');

        $today_placepercel = Parcel::where(['merchantId' => Session::get('merchantId')])->whereDate('created_at', Carbon::today())->count();

        $today_partial_return = Parcel::where(['merchantId' => Session::get('merchantId')])->select('partial_return_amount')->whereDate('created_at', Carbon::today())->sum('partial_return_amount');
        $total_partial_return = Parcel::where(['merchantId' => Session::get('merchantId')])->select('partial_return_amount')->sum('partial_return_amount');

        $pendingparcel = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->count();
        $pendingparcel_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->sum('cod');

        $today_pendingparcel = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->whereDate('created_at', Carbon::today())->count();
        $today_pendingparcel_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->whereDate('created_at', Carbon::today())->sum('cod');

        $parcle_transit = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 3])->count();
        $parcel_transit_total_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 3])->sum('cod');
         $parcle_picked = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 2])->count();
        $parcel_picked_total_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 2])->sum('cod');
        //today
        $today_transit = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 3])->whereDate('created_at', Carbon::today())->count();
        $today_transit_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 3])->whereDate('created_at', Carbon::today())->sum('cod');
        $today_picked = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 2])->whereDate('created_at', Carbon::today())->count();
        $today_picked_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 2])->whereDate('created_at', Carbon::today())->sum('cod');


        $deliverd = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->count();
        $total_delivered_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->sum('cod');
        $today_deliverd = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->whereDate('created_at', Carbon::today())->count();
        $today_delivered_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->whereDate('created_at', Carbon::today())->sum('cod');

        $cancelparcel = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->count();
        $cancelparcel_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->sum('cod');
        $today_cancelparcel = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->whereDate('created_at', Carbon::today())->count();
        $today_cancel_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->whereDate('created_at', Carbon::today())->sum('cod');
         //return count
        $parcelreturn = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 8])->count();
        $parcelreturn_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 8])->sum('cod');

        $return_hub = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 7])->count();
        $return_hub_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 7])->sum('cod');
        $return_pending = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 6])->count();
        $return_pending_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 6])->sum('cod');

        $today_parcelreturn = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 8])->whereDate('created_at', Carbon::today())->count();
        $today_parcelreturn_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 8])->whereDate('created_at', Carbon::today())->sum('cod');

        $today_return_to_pending = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 6])->whereDate('created_at', Carbon::today())->count();
        $today_return_to_pending_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 6])->whereDate('created_at', Carbon::today())->sum('cod');
        $today_return_to_hub = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 7])->whereDate('created_at', Carbon::today())->count();
        $today_return_to_hub_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 7])->whereDate('created_at', Carbon::today())->sum('cod');


        $totalhold = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 5])->count();
        $total_hold_count_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 5])->sum('cod');
        $today_totalhold = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 5])->whereDate('created_at', Carbon::today())->count();
        $today_hold_amount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 5])->whereDate('created_at', Carbon::today())->sum('cod');

        // $totalamount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->sum('merchantAmount') - ($returnDelCharge + $prepDelAmount + $return_charge);

        // $totalamount;

        // $today_totalamount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->whereDate('created_at', Carbon::today())->sum('merchantAmount') - ($returnDelCharge + $today_returnDelCharge + $today_prepDelAmount);
        // //   $merchantUnPaid=Parcel::where(['merchantId'=>Session::get('merchantId'),'status'=>4])->whereNull('merchantpayStatus')->sum('merchantAmount');
        // // return ;

        // return $today_totalamount;
        $merchantPaid = Parcel::where('status', 4)->where('merchantID', Session::get('merchantId'))->sum('merchantAmount');
        $merchantUnpaid = Parcel::where('status', 4)->where('merchantID', Session::get('merchantId'))->sum('merchantDue');

        $TodaymerchantPaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', Session::get('merchantId'))->sum('merchantAmount');
        $TodaymerchantUnpaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', Session::get('merchantId'))->sum('merchantDue');

        // $merchantPaid = $totalamount - $total ?? 0;
        $today_merchantPaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', Session::get('merchantId'))->sum('merchantAmount');

        $today_merchantUnPaid = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', Session::get('merchantId'))->sum('merchantDue');



        $todayamount = Parcel::where('status', 4)->whereDate('created_at', Carbon::today())->where('merchantID', Session::get('merchantId'))->sum('merchantAmount');

        $totalamount = Parcel::where('status', 4)->where('merchantID', Session::get('merchantId'))->sum('merchantAmount');

        $total_paid = $merchantPaid - $merchantUnpaid;
        $total_unpaid =  $merchantUnpaid;

        $today_paid = $today_merchantPaid - $today_merchantUnPaid;
        $today_unpaid = $today_merchantUnPaid;

        $merchant_info = Merchant::where('id', session::get('merchantId'))->select('firstName', 'companyName')->first();
        // return $merchant_info;


        return view('frontend.pages.merchant.dashboard.home', compact(
            'today_parcel_total','return_hub','return_pending','today_pendingparcel_amount','today_hold_amount','today_delivered_amount',
            'today_return_to_pending','today_return_to_hub','placepercel','today_cancel_amount','today_return_to_pending_amount','today_return_to_hub_amount',
            'today_placepercel', 'pendingparcel', 'today_pendingparcel','today_parcelreturn_amount','placepercel_amount','pendingparcel_amount','parcel_picked_total_amount',
            'deliverd', 'today_deliverd', 'parcelreturn', 'today_parcelreturn','parcel_transit_total_amount','total_delivered_amount','cancelparcel_amount',
            'cancelparcel', 'today_cancelparcel', 'totalhold', 'today_totalhold','return_pending_amount','return_hub_amount','parcelreturn_amount',
            'todayamount', 'total_paid', 'today_merchantUnPaid', 'today_paid','total_hold_count_amount',
            'today_transit', 'today_picked', 'today_merchantPaid', 'merchant_info',
            'parcle_transit', 'parcle_picked', 'today_partial_return', 'total_partial_return',
            'today_unpaid', 'total_unpaid',
            'totalamount','today_picked_amount','today_transit_amount'));
    }

    // get today percel
    public function today_parcels(Request $request)
    {
//        return "today_parcels";
        $filter = $request->filter_id;
        $parceltypes = Parceltype::all();

        if ($request->trackId != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->whereDate('parcels.created_at', Carbon::today())
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }elseif ($request->phoneNumber != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereDate('parcels.created_at', Carbon::today())
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }elseif ($request->trackId != null || $request->phoneNumber != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.trackingCode', $request->trackId)
                ->whereDate('parcels.created_at', Carbon::today())
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }elseif ($request->trackId != null || $request->phoneNumber != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.trackingCode', $request->trackId)
                ->whereDate('parcels.created_at', Carbon::today())
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } else{
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->whereDate('parcels.created_at', Carbon::today())
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }

        if ($request->invoiceNo) {
            $allparcel = $allparcel->where('invoiceNo', $request->invoiceNo);
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontend.pages.merchant.percel.parcels', compact('allparcel', 'parceltypes'));
    }

    // all percels
    public function parcels(Request $request)
    {
        $filter = $request->filter_id;
        $parceltypes = Parceltype::all();
        if ($request->trackId != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
//                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        }elseif ($request->startDate != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->startDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->endDate != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->trackId != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.trackingCode', $request->trackId)
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->latest()->get();
        }

        if ($request->invoiceNo) {
            $allparcel = $allparcel->where('invoiceNo', $request->invoiceNo);
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontend.pages.merchant.percel.allpercels', compact('allparcel', 'parceltypes'));
    }

    // merchant profile
    public function profile()
    {
        $merchantInfo = Merchant::find(Session::get('merchantId'));

        return view('frontend.pages.merchant.percel.profile', compact('merchantInfo'));
    }

    // parcel update
    public function parcelupdate(Request $request)
    {
        // return  $request->productPrice;
        $update_parcel = Parcel::find($request->hidden_id);
        $mercharntInfo = Merchant::find(Session::get('merchantId'));
        // return $mercharntInfo;

        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }
        $percelType = 1;
        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
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

        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $update_parcel->cod) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

        $merchantAmount = (round($update_parcel->cod - ($delivery_charge + $codcharge), 2));
        $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);

        // Update parcel
        // $update_parcel->invoiceNo = $request->invoiceno;
        $update_parcel->merchantId = Session::get('merchantId');
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
        //$update_parcel->deliveryCharge = round($delivery_charge, 2);
        $update_parcel->deliveryCharge = $request->deliveryCharge;
        $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
        $update_parcel->codCharge = round($codcharge, 2);
        $update_parcel->division_id = $request->division_id;
        $update_parcel->district_id = $request->district_id;
        $update_parcel->thana_id = $request->thana_id;
        $update_parcel->area_id = $request->area_id;
        $update_parcel->delivery_address = $request->delivery_address;
        $update_parcel->cod = $request->productPrice;
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

        return redirect()->back()->with('success', 'Thanks! your parcel update successfully');
    }


    public function paymentInvoices(Request $request)
    {
        if ($request->start_date != null && $request->end_date != null){
            $invoices = Merchantpayment::where('merchantId', Session::get('merchantId'))->with('getPercelDetails', 'geDeatilsMarchent')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = Merchantpayment::where('merchantId', Session::get('merchantId'))->with('getPercelDetails', 'geDeatilsMarchent')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = Merchantpayment::where('merchantId', Session::get('merchantId'))->with('getPercelDetails', 'geDeatilsMarchent')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }else{
            $invoices = Merchantpayment::where('merchantId', Session::get('merchantId'))->with('getPercelDetails', 'geDeatilsMarchent')->latest()->get();
        }
        return view('frontend.pages.merchant.payments.merchant_payment_invoice_list', compact('invoices'));

//        $invoices = Merchantpayment::where('merchantId', Session::get('merchantId'))->with('getPercelDetails', 'geDeatilsMarchent')->get();
        // return $invoices;
    }


    public function paymentInvoiceDetails($id)
    {

       $results =  Parcel::where('paymentInvoice', $id)->with('merchant')->select(
            'trackingCode','parcels.codCharge AS cch','recipientName','recipientAddress','recipientPhone','status','cod','partial_return_amount',
           'collected_amount','deliveryCharge','return_charge','merchantAmount',
        )->get();
        $amounts =  Parcel::where('paymentInvoice', $id)->with('merchant')->get();
        $data =  Parcel::where('paymentInvoice', $id)->with('merchant')->select('parcels.codCharge AS ccharge')->get();
        $marchant_details =  Parcel::where('paymentInvoice', $id)->with('merchant', 'parcelStatus')->first();
        $site_settings =  Setting::first();
        if($results) {
            $results->map(function($i) use($results) {
                $i->ccharge = $i->cch;
            });
        }
        if($data) {
            $data->map(function($i) use($data) {
                $i->c_charge = $i->ccharge;
            });
        }
        return view('frontend.pages.merchant.payments.merchant_payment_invoice', compact('results', 'data','amounts', 'marchant_details', 'site_settings'));
    }



}
