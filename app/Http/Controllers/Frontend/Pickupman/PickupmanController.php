<?php

namespace App\Http\Controllers\Frontend\Pickupman;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentThana;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\Pickupman;
use App\Models\PickupmanAgent;
use App\Models\PickupmanPayment;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PickupmanController extends Controller
{
    //
    public function dashboard()
    {
        //   $todaydate =  Carbon::today()->toDateString();

        //  return $dailypicked = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->count();

        // Daily parcel details
        $dailyparcel = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyparcel_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('cod');

        $dailypending = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 1])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypending_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 1])->whereDate('updated_at', Carbon::today()->toDateString())->sum('cod');

        $dailypicked = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypicked_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->sum('cod');

        $dailyintransit = Parcel::where(['pickupmanId' => Session::get('pickupmanId'),  'status' => 3])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $daily_partial_return = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->select('partial_return_amount')->whereDate('created_at', Carbon::today())->sum('partial_return_amount');
        $dailyhold = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 5])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailydelivered = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 4])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturnpending = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 6])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntohub = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 7])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntomarchant = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 8])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailycancled = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 9])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $today_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_amount');
        $today_paid = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_paid');
        $today_unpaid = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('pickupman_due');
        // dd($dailyparcel);
        // die();
        $totalparcel = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->count();
        $totalparcel_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('cod');
        $totalpending = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 1])->count();
        $totalpending_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 1])->sum('cod');

        $totalpicked = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 2])->count();
        $t_tranjit = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 3])->count();
        $totaldelivery = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 5])->count();
        $returnhub = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 7])->count();
        $returnmerchant = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 8])->count();
        $returnpendin = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 6])->count();
        $totalcancel = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 9])->count();
        $totalpicked_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 2])->sum('cod');
        $totaltransit = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 2])->count();
        $total_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_amount');
        $total_paid = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_paid');
        $total_due = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_due');
        $pickupman_info = Pickupman::where('id', Session::get('pickupmanId'))->select('name')->first();

        $totals_picked = parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereNotIn('status', [1])->count();
        return view('frontend.pages.pickupman.dashboard.home', compact(
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
            'pickupman_info',
            'dailyintransit',
            'daily_partial_return',
            'today_amount',
            'today_paid',
            'today_unpaid',
            'dailyparcel_amount',
            'dailypending_amount',
            'dailypicked_amount',
            'totalparcel_amount',
            'totalpending_amount',
            'totalpicked_amount',
            'totals_picked'
        ));
    }

    // All Parcel
    public function parcels(Request $request)
    {
        $filter = $request->filter_id;
        if ($request->trackId != null) {
             $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'ASC')
                 ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'ASC')
                ->latest()->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                 ->orderBy('parcels.status', 'asc')
                ->orderBy('created_at','ASC')->get();

        } elseif ($request->startDate != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                 ->orderBy('parcels.status', 'asc')
                ->orderBy('created_at','ASC')->get();

        } elseif ( $request->endDate != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->whereDate('parcels.created_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                 ->orderBy('parcels.status', 'asc')
                ->orderBy('created_at','ASC')->get();
        } elseif ($request->trackId != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.trackingCode', $request->trackId)
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->endOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.status', 'asc')
                ->orderBy('created_at','ASC')->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->orWhere('parcels.pickupmanId', Session::get('pickupmanId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
//                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->latest()->get();
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        $parceltypes = Parceltype::all();

        return view('frontend.pages.pickupman.percel.allpercels', compact('allparcel', 'parceltypes'));
    }

    public function withOutPending(){

        $allparcel = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->orWhere('parcels.pickupmanId', Session::get('pickupmanId'))
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
//           ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
            ->whereNotIn('parcels.status', [1])
            ->latest()->get();
//       $allparcel = parcel::where(['pickupmanId' => Session::get('pickupmanId')])->whereNotIn('status', [1])->get();
        $parceltypes = Parceltype::all();
        return view('frontend.pages.pickupman.percel.allpercels', compact('allparcel', 'parceltypes'));
    }


    // parcels pending
    public function pendingParcels(Request $request)
    {
        $pickupman = Pickupman::find(Session::get('pickupmanId'));
        $agent_ids = PickupmanAgent::where('pickupman_id', Session::get('pickupmanId'))->pluck('agent_id');
        $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');
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
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.id', 'desc')
                ->get();
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontend.pages.pickupman.percel.pending_percel', compact('allparcel', 'parceltypes'));
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
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')->orderBy('parcels.id', 'desc')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->whereBetween('parcels.udpated_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())

                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.updated_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->whereDate('parcels.updated_at', Carbon::today())
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->whereDate('parcels.updated_at', Carbon::today())
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        $parceltypes = Parceltype::all();

        return view('frontend.pages.pickupman.percel.todayparcel', compact('allparcel', 'parceltypes'));
    }

    // update status
    public function statusupdate(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'hidden_id' => 'required',
            'status' => 'required',
        ]);

        $parcel = Parcel::find($request->hidden_id);
        $merchantinfo = Merchant::find($parcel->merchantId);
        $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

        // return $pickupmanInfo;

        if ($request->status == 1) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->status == 2) {
            // return "hi";
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
        }

        $parcel->status = $request->status;
        $parcel->save();

        $pnote = Parceltype::find($request->status);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = 'Your parcel ' . $pnote->title;
        $note->save();

        return redirect()->back()->with('success', 'Parcel information updated');
    }

    // assignable
    public function assignable(Request $request)
    {
        $deliveryman = Pickupman::find(Session::get('pickupmanId'));

        $agent_ids = PickupmanAgent::where('pickupman_id', Session::get('pickupmanId'))->pluck('agent_id');
        // return $agent_ids;

        $thana_ids = AgentThana::whereIn('agent_id', $agent_ids)->pluck('thana_id');

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
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($request->phoneNumber != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        }elseif ($request->startDate != null){
             $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->whereDate('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay()])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        }elseif ($request->endDate != null){
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->whereDate('parcels.created_at', [Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        } elseif ($request->trackId != null || $request->phoneNumber != null && $request->startDate != null && $request->endDate != null) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [Carbon::parse($request->startDate)->startOfDay(), Carbon::parse($request->endDate)->endOfDay()])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
//                ->orderBy('parcels.id', 'desc')
                ->orderBy('created_at', 'ASC')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
//                ->orderBy('parcels.id', 'desc')
                ->latest()->get();
        }

        Session::put('parcel_count', count($allparcel));

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontend.pages.pickupman.percel.assignable', compact('allparcel', 'parceltypes'));
    }


    //  assignme
    public function assignme(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'hidden_id' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->pickupmanId = Session::get('pickupmanId');
        $parcel->save();

        $pickupman = Pickupman::find(Session::get('pickupmanId'));
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Pickupman Asign";
        $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
        $note->save();
        return redirect()->back()->with('success', 'Pickupman assigned successfully');
        $pickupmanInfo = Pickupman::find($parcel->pickupmanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        if ($merchantinfo->emailAddress) {
            $data = array(
                'contact_mail' => $merchantinfo->emailAddress,
                'ridername' => $pickupmanInfo->name,
                'riderphone' => $pickupmanInfo->phone,
                'codprice' => $parcel->cod,
                'trackingCode' => $parcel->trackingCode,
            );
            $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Parcel Assign Notification');
            });
        }
    }

    //  multiple assignme
    public function multipleAssignme(Request $request)
    {


        if ($request->parcel_select) {
            foreach ($request->parcel_select as $parcelid) {
                $parcel = Parcel::find($parcelid);
                $parcel->pickupmanId = Session::get('pickupmanId');
                $parcel->save();

                $pickupman = Pickupman::find(Session::get('pickupmanId'));
                $note = new Parcelnote();
                $note->parcelId = $parcelid;
                $note->note = 'Pickupman Assign';
                $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
                $note->save();
            }

            return redirect()->back()->with('success', 'Parcel assigned successfully');
        }
    }

    //  multiple pickup
    public function multiplePickup(Request $request)
    {
        // return $request->all();

        foreach ($request->parcel_select as $parcelId) {
            $parcel = Parcel::find($parcelId);
            $merchantinfo = Merchant::find($parcel->merchantId);
            $pickupmanInfo = Pickupman::where(['id' => Session::get('pickupmanId')])->first();
            $agentInfo = Agent::where(['id' => $parcel->agentId])->first();
            if ($request->updstatus == 2) {
                $parcel->pickup_date = now();
                if ($pickupmanInfo) {
                    $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                    $parcel->pickupman_paid = 0;
                    $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                    $parcel->save();
                }
                if ($agentInfo) {
                    // return $agentInfo->per_parcel_amount;

                    $parcel->agent_amount = $agentInfo->per_percel_amount;
                    $parcel->agent_paid = 0;
                    $parcel->agent_due = $agentInfo->per_percel_amount;
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

                // Send Customer message
                if ($parcel->recipientPhone) {
                    $customer_numbers = $parcel->recipientPhone;
                    $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n Stepup Courier ";
                    $this->sendSMS($customer_numbers, $customer_msg);
                }


                // Send Merchant message
                $numbers = '0' . $merchantinfo->phoneNumber;

                $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is RETURN. \r\n Regards,\r\n Stepup Courier";
                $this->sendSMS($numbers, $msg);
                $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
            }

            $parcel->status = $request->updstatus;
            $parcel->save();

            $pnote = Parceltype::find($request->updstatus);
            $note = new Parcelnote();
            $note->parcelId = $parcelId;
            $note->note = 'Your parcel ' . $pnote->title;
            $note->save();
        }

        return redirect()->back()->with('success', 'Parcel picked successfully');
    }


    public function paymentInvoices(Request $request)
    {
        if ($request->start_date != null && $request->end_date != null){
            $invoices = PickupmanPayment::where('pickupman_id', Session::get('pickupmanId'))->with('getPercelDetails', 'geDeatilsPickupman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = PickupmanPayment::where('pickupman_id', Session::get('pickupmanId'))->with('getPercelDetails', 'geDeatilsPickupman')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = PickupmanPayment::where('pickupman_id', Session::get('pickupmanId'))->with('getPercelDetails', 'geDeatilsPickupman')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }else{
            $invoices = PickupmanPayment::where('pickupman_id', Session::get('pickupmanId'))->with('getPercelDetails', 'geDeatilsPickupman')->latest()->get();
        }
        return view('frontend.pages.pickupman.payments.pickupman_payment_invoice_list', compact('invoices'));

    }


    public function paymentInvoiceDetails($id)
    {
        $results =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman','merchant')->get();
        $amounts =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $pickupman_details = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman', 'parcelStatus')->first();
        $site_settings =  Setting::first();
        return view('frontend.pages.pickupman.payments.pickupman_payment_invoice', compact('results', 'amounts', 'pickupman_details', 'site_settings'));
    }
    public function paymentInvoiceDownload($id){

        $results =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman','merchant')->get();
        $amounts =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $pickupman_details = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman', 'parcelStatus')->first();
        $site_settings =  Setting::first();

        $config = ['instanceConfigurator' => function ($mpdf) {
            $mpdf->SetWatermarkText('Sensor');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.05;
        }];
        $data = [
            'results' => $results,
            'amounts' => $amounts,
            'pickupman_details' => $pickupman_details,
            'site_settings' => $site_settings,
        ];
        $pdf = PDF::loadHtml(view('frontend.pages.pickupman.payments.pickupman_payment_invoice', $data), $config);
        $name = $pickupman_details->updated_at->format('d M Y g:i:s');
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');
    }


    public function profile()
    {

        $id = Session::get('pickupmanId');
        $pickupman = pickupman::find($id);
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::select('id', 'name')->get();
        $agent_id = PickupmanAgent::where('pickupman_id', $id)->pluck('agent_id')->toArray();
        $area_id = Pickupman::where('id', $id)->pluck('area_id')->toArray();

        return view('frontend.pages.pickupman.percel.profile', compact('pickupman', 'divisions', 'agent_id', 'area_id', 'districts'));
    }
}
