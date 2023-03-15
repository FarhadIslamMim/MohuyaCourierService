<?php

namespace App\Http\Controllers\Frontend\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentPayment;
use App\Models\Deliveryman;
use App\Models\DeliverymanAgent;
use App\Models\Parcel;
use App\Models\Parceltype;
use App\Models\Pickupman;
use App\Models\PickupmanAgent;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'hi';

        $agentInfo = Agent::where('id', Session::get('agentId'))->first();

        // Daily parcel details
        $dailyparcel = Parcel::where(['agentId' => Session::get('agentId')])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypending = Parcel::where(['agentId' => Session::get('agentId'),  'status' => 1])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailypicked = Parcel::where(['agentId' => Session::get('agentId'),  'status' => 2])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyintransit = Parcel::where(['agentId' => Session::get('agentId'),  'status' => 3])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $daily_partial_return = Parcel::where(['agentId' => Session::get('agentId')])->select('partial_return_amount')->whereDate('created_at', Carbon::today())->sum('partial_return_amount');
        $dailyhold = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 5])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailydelivered = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 4])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturnpending = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 6])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntohub = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 7])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailyreturntomarchant = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 8])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $dailycancled = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 9])->whereDate('updated_at', Carbon::today()->toDateString())->count();
        $today_amount = Parcel::where(['agentId' => Session::get('agentId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('agent_amount');
        $today_paid = Parcel::where(['agentId' => Session::get('agentId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('agent_paid');
        $today_unpaid = Parcel::where(['agentId' => Session::get('agentId')])->whereDate('updated_at', Carbon::today()->toDateString())->sum('agent_due');
        // dd($dailyparcel);
        // die();

        $totalparcel = Parcel::where(['agentId' => Session::get('agentId')])->count();
        $totalpending = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 1])->count();
        $totalpicked = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 2])->count();
        $totaltransit = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 2])->count();
        $totaldelivery = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 5])->count();
        $totalcancel = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 9])->count();
        $returnpendin = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 8])->count();
        $returnhub = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 7])->count();
        $total_amount = Parcel::where(['agentId' => Session::get('agentId')])->sum('agent_amount');
        $total_paid = Parcel::where(['agentId' => Session::get('agentId')])->sum('agent_paid');
        $total_due = Parcel::where(['agentId' => Session::get('agentId')])->sum('agent_due');

        return view('frontend.pages.agent.dashboard.home', compact(
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
            'agentInfo',
            'dailyintransit',
            'daily_partial_return',
            'today_amount',
            'today_paid',
            'today_unpaid',
        ));
    }


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
                ->where('parcels.agentId', Session::get('agentId'))
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
                ->where('parcels.agentId', Session::get('agentId'))
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
                ->where('parcels.agentId', Session::get('agentId'))
                ->whereBetween('parcels.updated_at', [$request->startDate, $request->endDate])
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
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.updated_at', [$request->startDate, $request->endDate])
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
                ->where('parcels.agentId', Session::get('agentId'))
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
        return view('frontend.pages.agent.percel.todayparcel', compact('allparcel', 'parceltypes'));
    }

    // deliveryman reports
    public function deliverymanReport(Request $request)
    {
        $deliverymans = DeliverymanAgent::where('agent_id', Session::get('agentId'))->with('getDeliveryMan')->get();
        // return $deliverymans;

        $deliveryman_info = Deliveryman::find($request->deliveryman_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        $dailyparcels = [];

        // if (($request->start_date != NULL && $request->end_date != NULL)) {
        //     $query->whereDate('updated_at', Carbon::today()->toDateString())->with(['parcelStatus', 'merchant']);
        // }
        // dd($request->end_date);
        if ($request->deliveryman_id) {
            $query->where('deliverymanId', $request->deliveryman_id);

            if (($request->start_date != null && $request->end_date != null) && (strtotime($request->start_date) != strtotime($request->end_date))) {
                $query->whereBetween('delivery_date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()]);
            }
            if (strtotime($request->start_date) == strtotime($request->end_date)) {
                $query->whereDate('delivery_date', date(Carbon::parse($request->start_date)));
            }
            if ($request->start_date != null && $request->end_date == null) {
                $query->whereDate('delivery_date', date(Carbon::parse($request->start_date)));
            }
            if ($request->start_date == null && $request->end_date == null) {
                $dailyparcels = Parcel::where(['deliverymanId' => $request->deliveryman_id])->whereDate('updated_at', Carbon::today()->toDateString())->with(['parcelStatus', 'merchant'])->get();
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }

            $parcels = $query->get();
        }

        $site_settings = Setting::first();

        // dd($dailyparcels);

        return view('frontend.pages.agent.reports.deliveryman_report', compact('parcels', 'dailyparcels', 'deliveryman_info', 'parcel_types', 'deliverymans', 'site_settings'));
    }

    // deliveryman reports
    public function pickupmanReport(Request $request)
    {
        $pickupmans = PickupmanAgent::where('agent_id', Session::get('agentId'))->with('getPickupMan')->get();
        // return $pickupmans;

        $pickupman_info = Pickupman::find($request->pickupman_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        $dailyparcels = [];

        // if (($request->start_date != NULL && $request->end_date != NULL)) {
        //     $query->whereDate('updated_at', Carbon::today()->toDateString())->with(['parcelStatus', 'merchant']);
        // }
        // dd($request->end_date);
        if ($request->pickupman_id) {
            $query->where('pickupmanId', $request->pickupman_id);

            if (($request->start_date != null && $request->end_date != null) && (strtotime($request->start_date) != strtotime($request->end_date))) {
                $query->whereBetween('delivery_date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()]);
            }
            if (strtotime($request->start_date) == strtotime($request->end_date)) {
                $query->whereDate('delivery_date', date(Carbon::parse($request->start_date)));
            }
            if ($request->start_date != null && $request->end_date == null) {
                $query->whereDate('delivery_date', date(Carbon::parse($request->start_date)));
            }
            if ($request->start_date == null && $request->end_date == null) {
                $dailyparcels = Parcel::where(['pickupmanId' => $request->pickupman_id])->whereDate('updated_at', Carbon::today()->toDateString())->with(['parcelStatus', 'merchant'])->get();
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }

            $parcels = $query->get();
        }

        $site_settings = Setting::first();

        // dd($dailyparcels);

        return view('frontend.pages.agent.reports.pickman_report', compact('parcels', 'dailyparcels', 'pickupman_info', 'parcel_types', 'pickupmans', 'site_settings'));
    }


    /**
     * Method paymentInvoices
     * Get all the payment information of the pickupman
     * @return void
     */
    public function paymentInvoices()
    {
        $invoices = AgentPayment::where('agentId', Session::get('agentId'))->with('getPercelDetails', 'geDeatilsAgent')->get();
        // return $invoices;
        return view('frontend.pages.agent.payments.agent_payment_invoice_list', compact('invoices'));
    }

    /**
     * Method paymentInvoiceDetails
     *
     * @param $id $id [Invoice Id]
     *
     * @return void
     */
    public function paymentInvoiceDetails($id)
    {
        $results = Parcel::where('agent_payment_invoice', $id)->with('agent','merchant')->get();
        $amounts = Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $agent_details = Parcel::where('agent_payment_invoice', $id)->with('agent', 'parcelStatus')->first();
        $site_settings = $site_settings = Setting::first();

        return view('frontend.pages.agent.payments.agent_payment_invoice', compact('results', 'amounts', 'agent_details', 'site_settings'));
    }
}
