<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Deliveryman;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Parceltype;
use App\Models\Pickupman;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportManageController extends Controller
{
    // report summary
    public function reportSummary(Request $request)
    {
        $parcel_types = Parceltype::all();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');
        $parcel = [];
        foreach ($parcel_types as $parcel_type) {
            $date_column = 'created_at';
            if ($parcel_type->id == 2) {
                $date_column = 'pickup_date';
            }
            if ($parcel_type->id == 4) {
                $date_column = 'delivery_date';
            }

            $parcel['today_' . $parcel_type->slug . '_quantity'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->count();
            $parcel['today_' . $parcel_type->slug . '_collection'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('cod');
            $parcel['today_' . $parcel_type->slug . '_delivery_charge'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('deliveryCharge');
            $parcel['today_' . $parcel_type->slug . '_codCharge'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('codCharge');
            $parcel['today_' . $parcel_type->slug . '_merchant_payable'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('merchantDue');
            $parcel['today_' . $parcel_type->slug . '_merchant_paid'] = Parcel::whereDate('merchantpayDate', '>=', $start_date)->whereDate('merchantpayDate', '<=', $end_date)->where('status', $parcel_type->id)->sum('merchantPaid');
        }
        $total_parcel = [];
        foreach ($parcel_types as $parcel_type) {
            $parcel['total_' . $parcel_type->slug . '_quantity'] = Parcel::where('status', $parcel_type->id)->count();
            $parcel['total_' . $parcel_type->slug . '_collection'] = Parcel::where('status', $parcel_type->id)->sum('cod');
            $parcel['total_' . $parcel_type->slug . '_delivery_charge'] = Parcel::where('status', $parcel_type->id)->sum('deliveryCharge');
            $parcel['total_' . $parcel_type->slug . '_codCharge'] = Parcel::where('status', $parcel_type->id)->sum('codCharge');
            $parcel['total_' . $parcel_type->slug . '_merchant_payable'] = Parcel::where('status', $parcel_type->id)->sum('merchantDue');
            $parcel['total_' . $parcel_type->slug . '_merchant_paid'] = Parcel::where('status', $parcel_type->id)->sum('merchantPaid');
        }

        return view('backend.pages.superadmin.reports.summary', compact('parcel_types', 'parcel', 'total_parcel', 'start_date', 'end_date'));
    }

    // merchant reports
    public function merchantReport(Request $request)
    {
        $per_page = $request->per_page ?? 100;
        $merchants = Merchant::orderBy('firstName')->verify()->where('status', 1)->get();
        $merchant_info = Merchant::find($request->merchant_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $total = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        if ($request->merchant_id) {
            $query->where('merchantId', $request->merchant_id);
            if ($request->start_date) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $query->whereDate('created_at', '<= ', $request->end_date);
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }
            $parcels = $query->get();
            $total = [
                'parcel' => $parcels->count(),
                'cod' => $parcels->whereIn('status', [1,2,3,4,5,6,7,8,9])->sum('cod'),
                'delivery_charge' => $parcels->whereIn('status', [1,2,3,4,5,6,7,8,9])->sum('deliveryCharge'),
                'cod_charge' => $parcels->whereIn('status', [1,2,3,4,5,6,7,8,9])->sum('codCharge'),
                'merchant_pay' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantAmount'),
                'merchant_payable' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantDue'),
                'merchant_paid' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantPaid'),
            ];
        }
        // dd($parcels);
        return view('backend.pages.superadmin.reports.merchant_report', compact('parcels', 'total', 'parcel_types', 'merchant_info', 'merchants'));
    }

    // deliveryman report
    public function deliverymanReport(Request $request)
    {
        $deliverymans = Deliveryman::orderBy('name')->where('status', 1)->get();
        $deliveryman_info = Deliveryman::find($request->deliveryman_id);
        $parcel_types = Parceltype::all();
        $site_settings = Setting::first();
        if ($request->start_date != null && $request->end_date != null){
            $parcels = Parcel::where('deliverymanId', $request->deliveryman_id)->with('parcelStatus','district', 'thana', 'area')->whereBetween('pickup_date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('pickup_date','ASC')->get();
        }elseif ($request->start_date !=null){
            $parcels = Parcel::where('deliverymanId', $request->deliveryman_id)->with('parcelStatus','district', 'thana', 'area')->whereDate('pickup_date', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('pickup_date','ASC')->get();
        }elseif ($request->end_date !=null){
            $parcels = Parcel::where('deliverymanId', $request->deliveryman_id)->with('parcelStatus','district', 'thana', 'area')->whereDate('pickup_date', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('pickup_date','ASC')->get();
        }else{
            $parcels = Parcel::where('deliverymanId', $request->deliveryman_id)->with('parcelStatus','district', 'thana', 'area')->latest()->get();
        }
      return view('backend.pages.superadmin.reports.deliveryman_report', compact('parcels',  'deliveryman_info', 'parcel_types', 'deliverymans', 'site_settings'));

    }

    // pickupman report
    public function pickupmanReport(Request $request)
    {
        $pickupmans = Pickupman::orderBy('name')->where('status', 1)->get();
        $pickupman_info = Pickupman::find($request->pickupman_id);
        $parcel_types = Parceltype::all();
        $site_settings = Setting::first();

        if ($request->start_date != null && $request->end_date != null){
            $parcels = Parcel::with('parcelStatus')->where('pickupmanId', $request->pickupman_id)->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','desc')->get();
        }elseif ($request->start_date !=null){
            $parcels = Parcel::with('parcelStatus')->where('pickupmanId', $request->pickupman_id)->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','desc')->get();
        }elseif ($request->end_date !=null){
            $parcels = Parcel::with('parcelStatus')->where('pickupmanId', $request->pickupman_id)->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','desc')->get();
        }else{
            $parcels = Parcel::with('parcelStatus')->where('pickupmanId', $request->pickupman_id)->latest()->get();
        }
        return view('backend.pages.superadmin.reports.pickupman_report', compact('parcels', 'pickupman_info', 'parcel_types', 'pickupmans', 'site_settings'));
    }

    // pickupman report
    public function agentReport(Request $request)
    {
        $per_page = $request->per_page ?? 100;
        $agents = Agent::orderBy('name')->where('status', 1)->get();
        $agent_info = Agent::find($request->agent_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        $dailyparcels = [];

        // search between

        if ($request->agent_id) {
            $query->where('agentId', $request->agent_id);

            if (($request->start_date != null && $request->end_date != null) && (strtotime($request->start_date) != strtotime($request->end_date))) {
                $query->whereBetween('created_at', [date('Y-m-d', strtotime($request->start_date)), date('Y-m-d', strtotime($request->end_date))]);
            }
            if (strtotime($request->start_date) == strtotime($request->end_date)) {
                $query->whereDate('created_at', date('Y-m-d', strtotime($request->start_date)));
            }
            if ($request->start_date != null && $request->end_date == null) {
                $query->whereDate('created_at', date('Y-m-d', strtotime($request->start_date)));
            }
            if ($request->start_date == null && $request->end_date == null) {
                $dailyparcels = Parcel::where(['agentId' => $request->agent_id])->whereDate('updated_at', Carbon::today()->toDateString())->with(['parcelStatus', 'merchant'])->get();
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

        return view('backend.pages.superadmin.reports.agent_report', compact('parcels', 'dailyparcels', 'agent_info', 'parcel_types', 'agents', 'site_settings'));
    }
}
