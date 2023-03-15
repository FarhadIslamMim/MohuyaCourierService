<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Merchantpayment;
use App\Models\Parcel;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MerchantPaymentController extends Controller
{
    //show merchant due payments
    public function merchantDuePaymentShow(Request $request)
    {
        $query = DB::table('merchants')
            ->whereExists(function ($query) {
                $query->select(DB::raw('parcels.merchantId'))
                    ->from('parcels')
                    ->whereRaw('parcels.merchantId = merchants.id')
                    ->whereRaw('parcels.status = 4')
                    // ->whereRaw('parcels.status = 8')
                    ->whereRaw('parcels.merchantpayStatus IS Null');
            });

        if ($request->mcompany_name) {
            $query->where('merchants.companyName', 'like', '%' . $request->mcompany_name . '%');
        }

        $results = $query->orderBy('merchants.id', 'desc')->paginate(10);

        // return $results;
        return view('backend.pages.superadmin.payments.merchant.merchant_due_payment', compact('results'));
    }

    // view the merchant due percels
    public function merchantDuePayment(Request $request, $id)
    {
        $in = [4, 6, 7, 8];

        $query = DB::table('parcels')->whereIn('status', $in)->where('merchantId', '=', $id)->whereNull('merchantpayStatus');
        if ($request->start_date) {
            $query->whereDate('delivery_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('delivery_date', '<= ', $request->end_date);
        }

        $results = $query->get();
        $marchant = $id;

        $minfo = Merchant::find($id);

        return view('backend.pages.superadmin.payments.merchant.merchant_due_percel', compact('results', 'marchant', 'minfo'));
    }

    // submit merchant dues
    public function submitPaymentDue(Request $request)
    {
        $mid = $request->merchantId;

        $totalparcel = ($request->parcel_id) ? count($request->parcel_id) : 0;
        if ($totalparcel > 0) {
            $payment = new Merchantpayment();
            $payment->merchantId = $request->merchantId;
            $payment->parcelId = $request->parcelId;
            $payment->save();

            $parcels_id = $request->parcel_id;
            $total = 0;
            $finaltotal = 0;
            $totaldelcharge = 0;

            foreach ($parcels_id as $parcel_id) {
                $parcel = Parcel::find($parcel_id);
                $parcel->paymentInvoice = $payment->id;
                $parcel->merchantPaid = $parcel->merchantAmount;
                $parcel->merchantDue = 0;
                $parcel->merchantpayDate = date('Y-m-d');
                $parcel->merchantpayStatus = 1;
                $parcel->save();

                $total += $parcel->merchantPaid;
            }

            $finaltotal = $total;
            $totalparcel = count(collect($request)->get('parcel_id'));
            $validMerchant = Merchant::find($request->merchantId);
            $number = '0' . $validMerchant->phoneNumber;
            $msg = 'A Payment (Invoice No. SC-' . $payment->id . ') has been issued of ' . $finaltotal . ' Tk where ' . $totalparcel . " Parcels were paid. Check Invoice on your dashboard. \r\n Regards,\r\n Stepup Courier ";

            $send_sms = $this->sendSMS($number, $msg);

            return redirect()->back()->with('success', 'Payment to merchant done successfully');
        } else {
            return redirect()->back()->with('error', 'Please select atleast 1 parcel then try again!');
        }
    }

    // merchant payment invoice
    public function merchantPaymentInvoice(Request $request)
    {
        if($request->merchant_id != null){
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->where('merchantId',$request->merchant_id)->get();
        }elseif ($request->start_date != null && $request->end_date != null){
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->merchant_id != null  && $request->start_date != null && $request->end_date != null){
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])
                ->where('merchantId',$request->merchant_id)
                ->orderBy('created_at','ASC')->get();
        } else{
            $invoices = Merchantpayment::with('getPercelDetails', 'geDeatilsMarchent')->latest()->get();
        }
        $merchant = Merchant::where('status',1)->get();
        return view('backend.pages.superadmin.payments.merchant.merchant_payment_invoice', compact('invoices','merchant'));
    }

    // merchant invoice export to pdf
    public function merchantPaymentInvoiceExport($id)
    {
       $results =  Parcel::where('paymentInvoice',  decrypt($id))->with('merchant')->select(
            'trackingCode','parcels.codCharge AS cch','recipientName','recipientAddress','recipientPhone','status','cod','partial_return_amount',
            'collected_amount','deliveryCharge','return_charge','merchantAmount',
        )->get();
        $amounts =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant')->get();
        $data =  Parcel::where('paymentInvoice',decrypt($id))->with('merchant')->select('parcels.codCharge AS ccharge')->get();
        $merchant_details =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant', 'parcelStatus')->first();
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
        return view('backend.pages.superadmin.payments.merchant.invoice_new', compact('results', 'data','amounts', 'merchant_details', 'site_settings'));

    }

    public function merchantPaymentInvoicePrint($id)
    {
        $results =  Parcel::where('paymentInvoice',  decrypt($id))->with('merchant')->select(
            'trackingCode','parcels.codCharge AS cch','recipientName','recipientAddress','recipientPhone','status','cod','partial_return_amount',
            'collected_amount','deliveryCharge','return_charge','merchantAmount',
        )->get();
        $amounts =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant')->get();
        $data =  Parcel::where('paymentInvoice',decrypt($id))->with('merchant')->select('parcels.codCharge AS ccharge')->get();
        $merchant_details =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant', 'parcelStatus')->first();
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
        return view('backend.pages.superadmin.payments.merchant.invoice_new_print', compact('results', 'amounts', 'data','merchant_details', 'site_settings'));

    }
    public function merchantPaymentInvoiceDownload($id)
    {
        $results =  Parcel::where('paymentInvoice',  decrypt($id))->with('merchant')->select(
            'trackingCode','parcels.codCharge AS cch','recipientName','recipientAddress','recipientPhone','status','cod','partial_return_amount',
            'collected_amount','deliveryCharge','return_charge','merchantAmount',
        )->get();
        $amounts =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant')->get();
        $data_value =  Parcel::where('paymentInvoice',decrypt($id))->with('merchant')->select('parcels.codCharge AS ccharge')->get();
        $merchant_details =  Parcel::where('paymentInvoice', decrypt($id))->with('merchant', 'parcelStatus')->first();
        return $name = $merchant_details->updated_at;
        $site_settings = Setting::first();
        if($results) {
            $results->map(function($i) use($results) {
                $i->ccharge = $i->cch;
            });
        }
        if($data_value) {
            $data_value->map(function($i) use($data_value) {
                $i->c_charge = $i->ccharge;
            });
        }
        $config = ['instanceConfigurator' => function ($mpdf) {
            $mpdf->SetWatermarkText('Sensor');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.05;
        }];
        $data = [
            'results' => $results,
            'amounts' => $amounts,
            'data_value'=>$data_value,
            'merchant_details' => $merchant_details,
            'site_settings' => $site_settings,
        ];
        $pdf = PDF::loadHtml(view('backend.pages.superadmin.payments.merchant.pdf', $data), $config);
        $name = $merchant_details->updated_at->format('d M Y g:i:s');
//      return $pdf->stream('document.pdf');
        return $pdf->stream($name . '.pdf');
    }
}
