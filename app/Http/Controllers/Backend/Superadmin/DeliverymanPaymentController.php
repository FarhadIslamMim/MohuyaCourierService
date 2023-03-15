<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use App\Models\DeliverymanPayment;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DeliverymanPaymentController extends Controller
{
    // show deliveryman payments
    public function index(Request $request)
    {
        $deliverymen = Deliveryman::where('status', 1)->paginate(15);
        // return $deliverymen;
        return view('backend.pages.superadmin.payments.deliveryman.deliveryman_payments_summary', compact('deliverymen'));
    }

    public function deliverymanPayments(Request $request, $type, $deliverymanId)
    {
        $tracking_no = $request->tracking_no;
        $marchantID = $request->marchantID;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $filterbyTrackingNo = Parcel::where('trackingCode', $tracking_no)->with('merchant')->get();
        $filterbymarchantID = Parcel::where('merchantId', $marchantID)->first();

        // dd($filterbyTrackingNo);

        $deliveryman = Deliveryman::find($deliverymanId);
        $merchants = Merchant::select('id', 'companyName')->get();

        $query = Parcel::where([
            'deliverymanId' => $deliverymanId,
        ])->where('status', '>', '1')->with('merchant','deliveryman');

        // dd($query);

        if ($type == 'paid') {
            $query->where('deliveryman_paid', '>', 0);
        }

        if ($type == 'due') {
            $query->where('deliveryman_due', '>', 0);
        }

        $deliveryman_parcels = $query->paginate(15);
        // return $deliveryman_parcels;

        $TrackingDatas = [];
        $marchantidDatas = [];
        // filter
        if ($filterbyTrackingNo) {
            $TrackingDatas = Parcel::where('trackingCode', $tracking_no)->where('deliveryman_due', '>', 0)->with('merchant')->get();
            // return $TrackingDatas;
        }
        if ($filterbymarchantID) {
            $marchantidDatas = Parcel::where('marchantID', $tracking_no)->where('deliveryman_due', '>', 0)->with('merchant')->get();
        }

        return view('backend.pages.superadmin.payments.deliveryman.deliveryman_payments', compact('deliveryman_parcels', 'deliveryman', 'type', 'merchants', 'TrackingDatas', 'marchantidDatas'));
    }

    // deliverymanPayment
    public function deliverymanPayment(Request $request)
    {
        $this->validate($request, [
            'parcel_id' => 'required',
        ]);

        $payment = new DeliverymanPayment();
        $payment->deliveryman_id = $request->deliverymanId;
        $payment->save();

        foreach ($request->parcel_id ?? [] as $key => $parcel_id) {
            $parcel = Parcel::find($parcel_id);
            $parcel->deliveryman_paid = $parcel->deliveryman_amount;
            $parcel->deliveryman_payment_invoice = $payment->id;
            $parcel->deliveryman_due = $parcel->deliveryman_amount - $parcel->deliveryman_paid;
            $parcel->save();
        }


        $msg = count($request->parcel_id) . ' percel paid successfully done.';

        return redirect()->back()->with('success', $msg);
    }



    // deliveryman payment
    public function deliverymanPaymentInvoice(Request $request)
    {
        if($request->deliveryman_id !=null){
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->where('deliveryman_id',$request->deliveryman_id)->get();
        }elseif ($request->start_date != null && $request->end_date != null){
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif($request->deliveryman_id !=null && $request->start_date != null && $request->end_date != null){
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])
                ->where('deliveryman_id',$request->deliveryman_id)
                ->orderBy('created_at','ASC')->get();
        }else{
            $invoices = DeliverymanPayment::with('getPercelDetails', 'geDeatilsDeliveryman')->latest()->get();
        }
        $data = Deliveryman::where('status',1)->get();
        return view('backend.pages.superadmin.payments.deliveryman.payment_invoice', compact('invoices','data'));
    }


    public function deliverymanPaymentInvoiceExport($id)
    {
        $results =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $amounts =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $deliveryman_details = Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'parcelStatus')->first();
        $site_settings = Setting::first();

        return view('backend.pages.superadmin.payments.deliveryman.deliveryman_payment_invoice', compact('results', 'amounts', 'deliveryman_details', 'site_settings'));

    }

    public function deliverymanPaymentInvoicePrint($id){

        $results =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $amounts =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $deliveryman_details = Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'parcelStatus')->first();
        $site_settings = Setting::first();

        return view('backend.pages.superadmin.payments.deliveryman.deliveryman_payment_invoice_print', compact('results', 'amounts', 'deliveryman_details', 'site_settings'));

    }

    public function deliverymanPaymentInvoiceDownload($id){

        $results =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $amounts =  Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman')->get();
        $deliveryman_details = Parcel::where('deliveryman_payment_invoice', $id)->with('deliveryman', 'parcelStatus')->first();
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
        $pdf = PDF::loadHtml(view('backend.pages.superadmin.payments.deliveryman.deliveryman_payment_invoice', $data), $config);
        $name = $deliveryman_details->updated_at;
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');
    }

}
