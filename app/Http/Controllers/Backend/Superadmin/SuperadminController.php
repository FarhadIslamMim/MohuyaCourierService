<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Charts\ParcelStatus;
use App\Http\Controllers\Controller;
use App\Imports\ParcelImport;
use App\Models\Deliverycharge;
use App\Models\Deliveryman;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\PackageExcludedWeights;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\PromotionalDiscount;
use App\Models\Setting;
use App\Models\TempImportParecel;
use App\Models\Thana;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SuperadminController extends Controller
{
    // dashboard
    public function dashboard()
    {

        //   Charts
        $today_pending_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '1')->count();
        $today_picked_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '2')->count();
        $today_in_transit_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '3')->count();
        $today_delivered_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '4')->count();
        $today_hold_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '5')->count();
        $today_return_pending_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '6')->count();
        $today_return_to_hub_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '7')->count();
        $today_return_to_merchant_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '8')->count();
        $today_cacnel_parcel = Parcel::whereDate('created_at', Carbon::today())->where('status', '9')->count();

        $today_picked_amount = Parcel::whereDate('created_at', Carbon::today())->where('status', '2')->sum('cod');
        $today_transit_amount = Parcel::whereDate('created_at', Carbon::today())->where('status', '3')->sum('cod');
        // return $today_pending_parcel;
        $parcel_status = new ParcelStatus;
        $parcel_status->labels(['Pending Parcel', 'Picked', 'In Transit', 'Delivered', 'Hold', 'Return Pending', 'Return to hub', 'Return to merchant', 'Canceled']);
        $parcel_status->dataset('Daily Parcel Status', 'doughnut', [$today_pending_parcel, $today_picked_parcel, $today_in_transit_parcel, $today_delivered_parcel, $today_hold_parcel, $today_return_pending_parcel, $today_return_to_hub_parcel, $today_return_to_merchant_parcel, $today_cacnel_parcel]);



        $all_pending_parcel = Parcel::where('status', '1')->count();
        $all_picked_parcel = Parcel::where('status', '2')->count();
        $all_in_transit_parcel = Parcel::where('status', '3')->count();
        $all_delivered_parcel = Parcel::where('status', '4')->count();
        $all_hold_parcel = Parcel::where('status', '5')->count();
        $all_return_pending_parcel = Parcel::where('status', '6')->count();
        $all_return_to_hub_parcel = Parcel::where('status', '7')->count();
        $all_return_to_merchant_parcel = Parcel::where('status', '8')->count();
        $all_cacnel_parcel = Parcel::where('status', '9')->count();
        // return $today_pending_parcel;
        $total_parcel_status = new ParcelStatus;
        $total_parcel_status->labels(['Pending Parcel', 'Picked', 'In Transit', 'Delivered', 'Hold', 'Return Pending', 'Return to hub', 'Return to merchant', 'Canceled']);
        $total_parcel_status->dataset('Total Parcel Status', 'line', [$all_pending_parcel, $all_picked_parcel, $all_in_transit_parcel, $all_delivered_parcel, $all_hold_parcel, $all_return_pending_parcel, $all_return_to_hub_parcel, $all_return_to_merchant_parcel, $all_cacnel_parcel]);





        // percel overall status
        $parceltypes = Parceltype::get();
        // $otpBalance = explode('BDt', $this->getOTPBalance());
        $otpBalance =  (float) filter_var($this->getOTPBalance(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        // $sms_balance =  (float) filter_var($this->smsBalance(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $balances =  json_decode($this->smsBalance());
        // $temp_sms_balance  =  $balances->data->sms_limit;
        $temp_sms_balance  =  0;
        // $otp  = $this->getOTPBalance();

        $temp_otp_Balance = floor($otpBalance / 0.30);
        // $temp_sms_balance = floor($sms_balance / 0.30);


        $deliveryman_location = Deliveryman::select('name', 'phone', 'latitude', 'longitude', 'location', 'image')->get();
        $d_location = $deliveryman_location;
        // return $balances;
        return view('backend.pages.superadmin.dashboard', compact('temp_otp_Balance', 'temp_sms_balance', 'parcel_status', 'total_parcel_status', 'd_location','today_picked_amount','today_transit_amount'));
    }

    // import percel
    public function importParcel(Request $request)
    {
        $temp_files = [];
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::orderBy('name')->where('status', 1)->get();
        $merchants = Merchant::verify()->orderBy('firstName')->get();
        $weights = Weight::where('status', 1)->get();
        if ($request->temp) {
            $temp_files = TempImportParecel::where('temp_no', $request->temp)->get();
            // return $temp_files;
        }

        return view('backend.pages.superadmin.percel.import', compact('temp_files', 'divisions', 'weights', 'merchants'));
    }

    // read excel filie
    public function importParcelRead(Request $request)
    {
        $path = $request->file('importFile');
        if ($request->has('importFile')) {
            $array = Excel::toArray(new ParcelImport, $path);

            $main_array = [];
            foreach ($array as $data) {
                foreach ($data as $value) {
                    //return $value;
                    $value['temp_no'] = 202;
                    array_push($main_array, $value);
                    //$main_array = $value;
                }
            }
            // return $main_array;
            TempImportParecel::insert($main_array);

            return redirect()->route('admin.import.parcel', 'temp=' . '202');
        }
    }

    // store import parcel
    public function storeImportParcel(Request $request)
    {
        $request->validate([
            'merchantId' => 'required'
        ], [
            'merchantId.required' => 'Please select a merchant'
        ]);

        // return $request->all();

        $length = count($request->productPrice);
        // return $length;
        $count = 0;

        for ($i = 0; $i < $length; $i++) {
            $mercharntInfo = Merchant::where('id', $request->merchantId)->first();

            // get inside city list
            // return $mercharntInfo;
            // return $inside_city;

            $thana_id = $request->thana_id[$i];
            $inside_city = $mercharntInfo->inside_city;

            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id)->get();

            // get subcity list
            $sub_city = $mercharntInfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id)->get();

            // get outside list
            $district_id = $request->district_id[$i];

            $outside_city = $mercharntInfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();
            // 
            // return $get_packages_outside_city;

            $excluded_weights = [];
            $excluded_weights_last_id = 1;

            if (count($get_packages_inside_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_sub_city) > 0) {
                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }
            if (count($get_packages_outside_city) > 0) {

                $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
                $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            }

            $percel_weight = $request->weight_id[$i];

            $weight = Weight::where('id', $percel_weight)->whereNotIn('id', $excluded_weights)->first();
            $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

            // return $percel_weight;

            $last_extra_weight = $weight_last_value->extra_weight;


            $thana = Thana::find($request->thana_id[$i]);


            $percelType = 1;

            if ($request->productPrice[$i] > 0) {
                $percelType = 2;  // COD Collection
            }
            $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();

            if ($mercharntInfo->fixed_charge) {
                $delivery_charge = $mercharntInfo->fixed_charge;
                $codcharge = 0;
            }


            // return $weight;

            if (!empty($weight)) {

                // get deliverycharge
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
                // Extra charge
                $extra_weight = $weight->value - 1;
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);


                // die();
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


                $codcharge = 0;
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice[$i]) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);



                // inside city packages
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;

                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                        // return $delivery_charge;

                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }

                // // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    return $package;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                        return $delivery_charge;
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }

                // outside city package
                // die();
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    // return $package;
                    $extra_weight = $weight->extra_weight - $last_extra_weight;
                    // return "Weight ".$extra_weight;

                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                        // return $delivery_charge;
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }




                $merchantAmount = (round($request->productPrice[$i] - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount, 2);
                $setting = Setting::first();
                $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
                $store_parcel = new Parcel();
                $store_parcel->invoiceNo = $request->invoiceNo[$i];
                $store_parcel->merchantId = $request->merchantId;
                $store_parcel->cod = $request->productPrice[$i];
                $store_parcel->percelType = $percelType;
                $store_parcel->recipientName = $request->recipientName[$i];
                $store_parcel->recipientAddress = $request->delivery_address[$i];
                $store_parcel->recipientPhone = $request->phonenumber[$i];
                $store_parcel->alternative_mobile_no = $request->alternative_mobile_no[$i];
                $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $store_parcel->pickLocation = $mercharntInfo->pickLocation;
                $store_parcel->productWeight = $weight->value;
                $store_parcel->trackingCode = $tracking_code;
                $store_parcel->note = $request->note;
                $store_parcel->deliveryCharge = round($delivery_charge, 2);
                $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $store_parcel->codCharge = round($codcharge, 2);
                $store_parcel->division_id = $request->division_id[$i];
                $store_parcel->district_id = $request->district_id[$i];
                $store_parcel->thana_id = $request->thana_id[$i];
                $store_parcel->delivery_address = $request->delivery_address[$i];
                $store_parcel->productPrice = 0;
                $store_parcel->merchantAmount = $merchantAmount;
                $store_parcel->merchantDue = 0;
                $store_parcel->orderType = $deliveryChargeInfo->id;
                $store_parcel->codType = $deliveryChargeInfo->id;
                $store_parcel->status = 1;
                $store_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $store_parcel->id;
                $note->note = 'Parcel create successfully';
                $note->save();

                if ($store_parcel && $note) {
                    $count++;
                }

                TempImportParecel::where('temp_no', $request->temp)->delete();
            } else {


                $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();

                if ($mercharntInfo->fixed_charge) {
                    $delivery_charge = $mercharntInfo->fixed_charge;
                    $codcharge = 0;
                }
                $weight = Weight::find($request->weight_id[$i]);

                // return $weight;
                $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

                // Extra charge
                $extra_weight = $weight->value - 1;
                $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);


                // die();
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
                $codcharge = 0;
                $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice[$i]) / 100;
                $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


                // inside city packages
                if (count($get_packages_inside_city) > 0) {
                    $package = DeliveryPackage::where('id', $inside_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }

                // sub city package
                if (count($get_packages_sub_city) > 0) {
                    $package = DeliveryPackage::where('id', $sub_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }
                // outside city package
                if (count($get_packages_outside_city) > 0) {
                    $package = DeliveryPackage::where('id', $outside_city)->first();
                    $extra_weight = 0;
                    if ($extra_weight > 0) {
                        $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    } else {
                        $delivery_charge = $package->delivery_charge;
                    }
                    $codcharge = floatval($request->productPrice[$i] * $package->cod_charge) / 100;
                }


                // return $delivery_charge;


                $merchantAmount = (round($request->productPrice[$i] - ($delivery_charge + $codcharge), 2));
                $merchantDue = round($merchantAmount, 2);
                $setting = Setting::first();
                $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
                $store_parcel = new Parcel();
                $store_parcel->invoiceNo = $request->invoiceNo[$i];
                $store_parcel->merchantId = $request->merchantId;
                $store_parcel->cod = $request->productPrice[$i];
                $store_parcel->percelType = $percelType;
                $store_parcel->recipientName = $request->recipientName[$i];
                $store_parcel->recipientAddress = $request->delivery_address[$i];
                $store_parcel->recipientPhone = $request->phonenumber[$i];
                $store_parcel->alternative_mobile_no = $request->alternative_mobile_no[$i];
                $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
                $store_parcel->pickLocation = $mercharntInfo->pickLocation;
                $store_parcel->productWeight = $weight->value;
                $store_parcel->trackingCode = $tracking_code;
                $store_parcel->note = $request->note;
                $store_parcel->deliveryCharge = round($delivery_charge, 2);
                $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
                $store_parcel->codCharge = round($codcharge, 2);
                $store_parcel->division_id = $request->division_id[$i];
                $store_parcel->district_id = $request->district_id[$i];
                $store_parcel->thana_id = $request->thana_id[$i];
                $store_parcel->delivery_address = $request->delivery_address[$i];
                $store_parcel->productPrice = 0;
                $store_parcel->merchantAmount = $merchantAmount;
                $store_parcel->merchantDue = 0;
                $store_parcel->orderType = $deliveryChargeInfo->id;
                $store_parcel->codType = $deliveryChargeInfo->id;
                $store_parcel->status = 1;
                $store_parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $store_parcel->id;
                $note->note = 'Parcel create successfully';
                $note->save();

                if ($store_parcel && $note) {
                    $count++;
                }
            }

            TempImportParecel::where('temp_no', $request->temp)->delete();
        }

        if ($count == $length) {
            TempImportParecel::where('temp_no', $request->temp)->delete();

            return back()->with('success', 'Percel Created Successfully');
        }
    }



    // speedup
    public function speeUP()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'Software speed up successfully!');
    }


    // barcode scanner
    public function barcodeScanner(Request $request)
    {
        return view('backend.pages.superadmin.scanner.scanner');
    }

    // get customer details
    public function getCustomerDetails(Request $request)
    {
        $query = DB::table('parcels')->select('id', 'recipientName', 'recipientPhone')->where('recipientPhone', 'LIKE', "%{$request->phone_number}%")->paginate(2);
        $output = '';
        $output = '<ul class="list-group" style="display: block; position:absolute; width:100%; z-index:5555">';
        foreach ($query as $row) {
            $output .= '<li class="list-group-item"><a id="customer_id" customer-id=' . $row->id . ' href="javascript:void(0)">' . $row->recipientName . '-' . $row->recipientPhone . '</a></li>';
        }
        $output .= '</ul>';
        return $output;
    }

    // set customer details
    public function setCustomerDetails(Request $request)
    {
        $query = DB::table('parcels')->select('id', 'recipientName', 'recipientPhone', 'division_id', 'district_id', 'thana_id', 'area_id', 'delivery_address')->where('id', $request->id)->first();

        return response()->json($query);
    }


    // /**
    //  * Method liveLocation
    //  *
    //  * @return void
    //  */
    // public function liveLocation()
    // {
    //     return $deliveryman_location;
    // }
}
