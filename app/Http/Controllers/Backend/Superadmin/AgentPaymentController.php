<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentPayment;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AgentPaymentController extends Controller
{
    // show agent payments
    public function index(Request $request)
    {
        $agents = Agent::where('status', 1)->paginate(15);
        // return $agents;
        return view('backend.pages.superadmin.payments.agent.agent_payments_summary', compact('agents'));
    }

    public function agentPayments(Request $request, $type, $agentId)
    {
        $tracking_no = $request->tracking_no;
        $marchantID = $request->marchantID;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $filterbyTrackingNo = Parcel::where('trackingCode', $tracking_no)->with('merchant')->get();
        $filterbymarchantID = Parcel::where('merchantId', $marchantID)->first();

        // dd($filterbyTrackingNo);

        $agent = Agent::find($agentId);
        //    return $agent;
        $merchants = Merchant::select('id', 'companyName')->get();

        $query = Parcel::where([
            'agentId' => $agentId,
        ])->where('status', '>', '0')->with('merchant');


        if ($type == 'paid') {
            $query->where('agent_paid', '>', 0);
        }

        if ($type == 'due') {
            $query->where('agent_due', '>', 0);
        }

        $agent_parcels = $query->get();
        // return $agent_parcels;

        $TrackingDatas = [];
        $marchantidDatas = [];
        // filter
        if ($filterbyTrackingNo) {
            $TrackingDatas = Parcel::where('trackingCode', $tracking_no)->where('agent_due', '>', 0)->with('merchant')->get();
            // return $TrackingDatas;
        }
        if ($filterbymarchantID) {
            $marchantidDatas = Parcel::where('marchantID', $tracking_no)->where('agent_due', '>', 0)->with('merchant')->get();
        }

        return view('backend.pages.superadmin.payments.agent.agent_payments', compact('agent_parcels', 'agent', 'type', 'merchants', 'TrackingDatas', 'marchantidDatas'));
    }

    // agentPayment
    public function agentPayment(Request $request)
    {
        $this->validate($request, [
            'parcel_id' => 'required',
        ]);

        $payment = new AgentPayment();
        $payment->agentId = $request->agentId;
        $payment->save();

        // die();

        foreach ($request->parcel_id ?? [] as $key => $parcel_id) {

            $parcel = Parcel::find($parcel_id);
            $parcel->agent_paid = $parcel->agent_amount;
            $parcel->agent_payment_invoice = $payment->id;
            $parcel->agent_due = $parcel->agent_amount - $parcel->agent_paid;
            $parcel->save();
        }


        $msg = count($request->parcel_id) . ' percel paid successfully done.';

        return redirect()->back()->with('success', $msg);
    }

    // agentPaymentInvoice
    public function agentPaymentInvoice(Request $request)
    {
//        return  $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->get();
        if($request->agent_id !=null){
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->where('agentId',$request->agent_id)->get();
        }elseif ($request->start_date != null && $request->end_date != null){
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->agent_id !=null && $request->start_date != null && $request->end_date != null){
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])
                ->where('agentId',$request->agent_id)
                ->orderBy('created_at','ASC')->get();
        }else{
            $invoices = AgentPayment::with('getPercelDetails', 'geDeatilsAgent')->get();
        }
        $agents = Agent::where('status', 1)->get();
        return view('backend.pages.superadmin.payments.agent.payment_invoice', compact('invoices','agents'));
    }

    public function agentPaymentInvoiceExport($id)
    {
        $results =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $amounts =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $agent_details =  Parcel::where('agent_payment_invoice', $id)->with('agent', 'parcelStatus')->first();
        $site_settings =  Setting::first();

        return view('backend.pages.superadmin.payments.agent.agent_payment_invoice', compact('results', 'amounts', 'agent_details', 'site_settings'));

    }
    public function agentPaymentInvoicePrint($id){

        $results =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $amounts =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $agent_details =  Parcel::where('agent_payment_invoice', $id)->with('agent', 'parcelStatus')->first();
        $site_settings =  Setting::first();

        return view('backend.pages.superadmin.payments.agent.payment_invoice_print', compact('results', 'amounts', 'agent_details', 'site_settings'));

    }
    public  function agentPaymentInvoiceDownload($id){

        $results =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $amounts =  Parcel::where('agent_payment_invoice', $id)->with('agent')->get();
        $agent_details =  Parcel::where('agent_payment_invoice', $id)->with('agent', 'parcelStatus')->first();
        $site_settings =  Setting::first();

        $config = ['instanceConfigurator' => function ($mpdf) {
            $mpdf->SetWatermarkText('Sensor');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.05;
        }];
        $data = [
            'results' => $results,
            'amounts' => $amounts,
            'agent_details' => $agent_details,
            'site_settings' => $site_settings,
        ];
        $pdf = PDF::loadHtml(view('backend.pages.superadmin.payments.agent.agent_payment_invoice', $data), $config);
        $name = $agent_details->updated_at;
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');



    }
}
