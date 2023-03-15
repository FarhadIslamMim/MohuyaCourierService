<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Models\Pickupman;
use App\Models\PickupmanPayment;
use App\Models\Setting;
use Carbon\Carbon;
use Doctrine\DBAL\Driver\Middleware\AbstractConnectionMiddleware;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PickupmanPaymentController extends Controller
{
    //show pickupman payment summary page
    public function index(Request $request)
    {
        $pickupmen = Pickupman::where('status', 1)->paginate(15);

        return view('backend.pages.superadmin.payments.pickupman.pickupman_payments_summary', compact('pickupmen'));
    }

    // pickupman Payments
    public function pickupmanPayments(Request $request, $type, $pickupmanId)
    {
        $tracking_no = $request->tracking_no;
        $marchantID = $request->marchantID;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $filterbyTrackingNo = Parcel::where('trackingCode', $tracking_no)->with('merchant')->get();
        $filterbymarchantID = Parcel::where('merchantId', $marchantID)->first();

        $pickupman = Pickupman::find($pickupmanId);
        $merchants = Merchant::select('id', 'companyName')->get();

        $query = Parcel::where('pickupmanId', $pickupmanId)->where('status', '>', 1);
        $merchants = Merchant::select('id', 'companyName')->get();
        if ($type == 'paid') {
            $query->where('pickupman_due', 0);
        }

        if ($type == 'due') {
            $query->where('pickupman_due', '>', 0);
        }

        $pickupman_parcels = $query->paginate(15);

        $TrackingDatas = [];
        $marchantidDatas = [];
        // filter
        if ($filterbyTrackingNo) {
            $TrackingDatas = Parcel::where('trackingCode', $tracking_no)->where('pickupman_due', '>', 0)->with('merchant')->get();
            // return $TrackingDatas;
        }
        if ($filterbymarchantID) {
            $marchantidDatas = Parcel::where('marchantID', $tracking_no)->where('pickupman_due', '>', 0)->with('merchant')->get();
        }

        return view('backend.pages.superadmin.payments.pickupman.pickupman_payments', compact('pickupman_parcels', 'pickupman', 'type', 'merchants', 'TrackingDatas', 'marchantidDatas'));
    }

    public function pickupmanPayment(Request $request)
    {
        $this->validate($request, [
            'parcel_id' => 'required',
        ]);

        $payment = new PickupmanPayment();
        $payment->pickupman_id = $request->pickupmanId;
        $payment->save();

        foreach ($request->parcel_id as $parcel_id) {
            $parcel = Parcel::find($parcel_id);
            $parcel->pickupman_paid = $parcel->pickupman_amount;
            $parcel->pickupman_payment_invoice = $payment->id;
            $parcel->pickupman_due = $parcel->pickupman_amount - $parcel->pickupman_paid;
            $parcel->save();
        }
        $msg = count($request->parcel_id) . ' percel paid successfully done.';

        return redirect()->back()->with('success', $msg);
    }


    // deliveryman payment
    public function PickupmanPaymentInvoice(Request $request)
    {
        if($request->pickupman_id !=null){
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->where('pickupman_id',$request->pickupman_id)->get();
        }elseif ($request->start_date != null && $request->end_date != null){
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->pickupman_id !=null && $request->start_date != null && $request->end_date != null){
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])
                ->where('pickupman_id',$request->pickupman_id)
                ->orderBy('created_at','ASC')->get();
        }else{
            $invoices = PickupmanPayment::with('getPercelDetails', 'geDeatilsPickupman')->latest()->get();
        }
        $pickupman = Pickupman::where('status',1)->get();
        return view('backend.pages.superadmin.payments.pickupman.payment_invoice', compact('invoices','pickupman'));

    }

    public function PickupmanPaymentInvoicePrint($id){

        $results = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $amounts = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $pickupman_details =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman', 'parcelStatus')->first();
        $site_settings = Setting::first();

        return view('backend.pages.superadmin.payments.pickupman.payment_invoice_print', compact('results', 'amounts', 'pickupman_details', 'site_settings'));

    }
    public  function PickupmanPaymentInvoiceDownload($id){

        $results = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $amounts = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $pickupman_details =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman', 'parcelStatus')->first();
        $site_settings = Setting::first();

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
        $pdf = PDF::loadHtml(view('backend.pages.superadmin.payments.pickupman.pickupman_payment_invoice', $data), $config);
        $name = $pickupman_details->updated_at;
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');



    }

    public function PickupmanPaymentInvoiceExport($id)
    {
        $results = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $amounts = Parcel::where('pickupman_payment_invoice', $id)->with('pickupman')->get();
        $pickupman_details =  Parcel::where('pickupman_payment_invoice', $id)->with('pickupman', 'parcelStatus')->first();
        $site_settings = Setting::first();

        return view('backend.pages.superadmin.payments.pickupman.pickupman_payment_invoice', compact('results', 'amounts', 'pickupman_details', 'site_settings'));

    }
}
