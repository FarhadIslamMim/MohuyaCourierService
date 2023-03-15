<?php

namespace App\Http\Controllers\Frontend\Merchant;

use App\Http\Controllers\Controller;
use App\Imports\ParcelImport;
use App\Models\Codcharge;
use App\Models\Deliverycharge;
use App\Models\DeliveryChargeHead;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\MerchantExcludedWeights;
use App\Models\PackageExcludedWeights;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\PromotionalDiscount;
use App\Models\Setting;
use App\Models\TempImportParecel;
use App\Models\Thana;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MerchantParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $codcharge = Codcharge::where('status', 1)->orderBy('id', 'DESC')->first();
        $merchant = Merchant::find(Session::get('merchantId'));
        $weights = Weight::where('status', 1)->get();
        Session::forget('codpay');
        Session::forget('pcodecharge');
        Session::forget('pdeliverycharge');

        return view('frontend.pages.merchant.percel.create', compact('codcharge', 'divisions', 'pickup_thanas', 'weights', 'delivery_charge_heads', 'merchant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            //'delivery_address' => 'required',
        ]);

        //clear session
        Session::forget('codpay');
        Session::forget('pcodecharge');
        Session::forget('pdeliverycharge');

        $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();
        $thana_id = Thana::find($request->thana_id);
        // get inside city list
        $inside_city = $mercharntInfo->inside_city;
        $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id->id)->get();

        // get subcity list
        $sub_city = $mercharntInfo->sub_city;
        $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id->id)->get();


        // get outside list
        $district_id = $request->district_id;

        $outside_city = $mercharntInfo->outside_city;
        $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


        $excluded_weights = [];
        $excluded_weights_last_id = 1;

        if (count($get_packages_inside_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }
        if (count($get_packages_sub_city) > 0) {

            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();

            // return $excluded_weights;
        }
        if (count($get_packages_outside_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }

        $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
        $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

        $last_extra_weight = $weight_last_value->extra_weight ?? 0;


        // return $get_packages_inside_city;
        if (empty($thana_id->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }

        $percelType = 1;

        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }
        $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana_id->deliverycharge_id])->first();

        if ($mercharntInfo->fixed_charge) {
            $delivery_charge = $mercharntInfo->fixed_charge;
            $codcharge = 0;
        }



        if (!empty($weight)) {
            // get deliverycharge
            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
            // Extra charge
            $extra_weight = $weight->value - 1;
            // return $extra_weight;
            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

            // return $delivery_charge;
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

            // return $delivery_charge;
            // cod charge
            // $codChargeInfo = Codcharge::where(['status' => 1])->first();
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


            // inside city packages
            if (count($get_packages_inside_city) > 0) {
                $package = DeliveryPackage::where('id', $inside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }

            // sub city package
            if (count($get_packages_sub_city) > 0) {
                $package = DeliveryPackage::where('id', $sub_city)->first();

                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }

            // outside city package
            if (count($get_packages_outside_city) > 0) {
                $package = DeliveryPackage::where('id', $outside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }


            // return $delivery_charge;

            $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
            $merchantDue = round($merchantAmount, 2);
            $setting = Setting::first();
            $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
            $store_parcel = new Parcel();
            $store_parcel->invoiceNo = $request->invoiceNo;
            $store_parcel->merchantId = Session::get('merchantId');
            $store_parcel->cod = $request->productPrice;
            $store_parcel->percelType = $percelType;
            $store_parcel->recipientName = $request->name;
            $store_parcel->recipientAddress = $request->delivery_address;
            $store_parcel->recipientPhone = $request->phonenumber;
            $store_parcel->alternative_mobile_no = $request->alternative_mobile_no;
            $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
            $store_parcel->pickLocation = $mercharntInfo->pickLocation;
            $store_parcel->productWeight = $weight->value;
            $store_parcel->trackingCode = $tracking_code;
            $store_parcel->note = $request->note;
            $store_parcel->deliveryCharge = round($delivery_charge, 2);
            $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
            $store_parcel->codCharge = round($codcharge, 2);
            $store_parcel->division_id = $request->division_id;
            $store_parcel->district_id = $request->district_id;
            $store_parcel->thana_id = $request->thana_id;
            $store_parcel->area_id = $request->area_id;
            $store_parcel->delivery_address = $request->delivery_address;
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

            if ($store_parcel) {
                return back()->with('success', 'Percel Created Successfully');
            }
        } else {



            $weight = Weight::find($request->weight_id);
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

            // cod charge
            // $codChargeInfo = Codcharge::where(['status' => 1])->first();
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
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
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }

            // sub city package
            if (count($get_packages_sub_city) > 0) {
                $package = DeliveryPackage::where('id', $sub_city)->first();
                // return $package;
                $extra_weight = 0;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }

            // outside city package
            if (count($get_packages_outside_city) > 0) {
                $package = DeliveryPackage::where('id', $outside_city)->first();
                $extra_weight = 0;
                // return "Weight " . $extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->productPrice * $package->cod_charge) / 100;
            }

            // return $delivery_charge;

            $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
            $merchantDue = round($merchantAmount, 2);
            $setting = Setting::first();
            $tracking_code = $setting->tracking_prefix . '-' . mt_rand(111111, 999999);
            $store_parcel = new Parcel();
            $store_parcel->invoiceNo = $request->invoiceNo;
            $store_parcel->merchantId = Session::get('merchantId');
            $store_parcel->cod = $request->productPrice;
            $store_parcel->percelType = $percelType;
            $store_parcel->recipientName = $request->name;
            $store_parcel->recipientAddress = $request->delivery_address;
            $store_parcel->recipientPhone = $request->phonenumber;
            $store_parcel->alternative_mobile_no = $request->alternative_mobile_no;
            $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
            $store_parcel->pickLocation = $mercharntInfo->pickLocation;
            $store_parcel->productWeight = $weight->value;
            $store_parcel->trackingCode = $tracking_code;
            $store_parcel->note = $request->note;
            $store_parcel->deliveryCharge = round($delivery_charge, 2);
            $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
            $store_parcel->codCharge = round($codcharge, 2);
            $store_parcel->division_id = $request->division_id;
            $store_parcel->district_id = $request->district_id;
            $store_parcel->thana_id = $request->thana_id;
            $store_parcel->area_id = $request->area_id;
            $store_parcel->delivery_address = $request->delivery_address;
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

            if ($store_parcel) {
                return back()->with('success', 'Percel Created Successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parceldetails = DB::table('parcels')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('merchantId', Session::get('merchantId'))
            ->where('parcels.id', '=', $id)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
            ->first();
        // dd($parceldetails);
        $trackInfos = Parcelnote::where('parcelId', $id)->orderBy('id', 'ASC')->get();
        if ($parceldetails) {
            return view('frontend.pages.merchant.percel.show', compact('parceldetails', 'trackInfos'));
        } else {
            return redirect()->back()->with('error', 'Percel Not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parceledit = Parcel::where(['merchantId' => Session::get('merchantId'), 'id' => $id])->first();
        if ($parceledit != null) {
            $merchant = Merchant::find(Session::get('merchantId'));
            $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
            $ordertype = Deliverycharge::find($parceledit->orderType);
            $codcharge = Codcharge::find($parceledit->codType);
            $divisions = Division::orderBy('name')->where('status', 1)->get();
            $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
            $weights = Weight::where('status', 1)->get();
            Session::put('codpay', $parceledit->cod);
            Session::put('pcodecharge', $parceledit->codCharge);
            Session::put('pdeliverycharge', $parceledit->deliveryCharge);

            return view('frontend.pages.merchant.percel.edit', compact('merchant', 'weights', 'delivery_charge_heads', 'ordertype', 'codcharge', 'parceledit', 'divisions', 'pickup_thanas'));
        } else {
            return redirect()->back()->with('error', 'Wrong process');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // return $request->all();
        $this->validate($request, [
            'hidden_id' => 'required',
            'invoiceNo' => 'nullable|unique:parcels,invoiceNo,' . $request->hidden_id,
            // 'pickup_thana_id' => 'required',
            // 'pickLocation' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'deliveryCharge' => 'nullable',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ]);
        $update_parcel = Parcel::find($request->hidden_id);
        $thana_id = Thana::find($update_parcel->thana_id);
        $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();


        $inside_city = $mercharntInfo->inside_city ?? 0;
        $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id->id)->get();


        // get subcity list
        $sub_city = $mercharntInfo->sub_city ?? 0;
        $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id->id)->get();

        // get outside list
        $district_id = $request->district_id;
        $outside_city = $mercharntInfo->outside_city ?? 0;
        $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


        $excluded_weights = [];
        $excluded_weights_last_id = 1;

        if (count($get_packages_inside_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
            // return $excluded_weights_last_id;
        }
        if (count($get_packages_sub_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }
        if (count($get_packages_outside_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }

        $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
        $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

        $last_extra_weight = $weight_last_value->extra_weight;




        if (empty($thana_id->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }




        if (!empty($last_extra_weight)) {

            $percelType = 1;
            if ($request->productPrice > 0) {
                $percelType = 2;  // COD Collection
            }
            $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana_id->deliverycharge_id])->first();
            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

            // return $delivery_charge;
            // Extra charge
            $extra_weight = $weight->value + 0.5;
            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

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
            // $codChargeInfo = Codcharge::where(['status' => 1])->first();
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->cod) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

            // inside city packages
            if (count($get_packages_inside_city) > 0) {
                $package = DeliveryPackage::where('id', $inside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                    // return $delivery_charge;
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
            }

            // sub city package
            if (count($get_packages_sub_city) > 0) {
                $package = DeliveryPackage::where('id', $sub_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
            }

            // outside city package
            if (count($get_packages_outside_city) > 0) {
                $package = DeliveryPackage::where('id', $outside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
            }



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
            $update_parcel->deliveryCharge = $delivery_charge;
            // $update_parcel->deliveryCharge = $request->deliveryCharge;
            $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
            $update_parcel->codCharge = round($codcharge, 2);
            $update_parcel->division_id = $request->division_id;
            $update_parcel->district_id = $request->district_id;
            $update_parcel->thana_id = $request->thana_id;
            $update_parcel->area_id = $request->area_id;
            $update_parcel->delivery_address = $request->delivery_address;
            $update_parcel->productPrice = 0;
            $update_parcel->cod = $request->cod;
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
        } else {


            $percelType = 1;
            if ($request->productPrice > 0) {
                $percelType = 2;  // COD Collection
            }


            // get deliverycharge   
            $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana_id->deliverycharge_id])->first();
            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

            // Extra charge
            $extra_weight = $weight->value - 1;

            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);
            // return $delivery_charge;

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
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->cod) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


            // return $get_packages_sub_city;
            if (count($get_packages_inside_city) > 0) {
                $package = DeliveryPackage::where('id', $inside_city)->first();
                $extra_weight = 0;
                if ($extra_weight > 0) {
                    $delivery_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge);
                } else {
                    $delivery_charge = $package->delivery_charge;
                }
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
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
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
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
                $codcharge = floatval($request->cod * $package->cod_charge) / 100;
            }


            $merchantAmount = (round($update_parcel->cod - ($delivery_charge + $codcharge), 2));
            $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);

            // Update parcel
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
            $update_parcel->deliveryCharge = $delivery_charge;
            $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
            $update_parcel->codCharge = round($codcharge, 2);
            $update_parcel->division_id = $request->division_id;
            $update_parcel->district_id = $request->district_id;
            $update_parcel->thana_id = $request->thana_id;
            $update_parcel->area_id = $request->area_id;
            $update_parcel->delivery_address = $request->delivery_address;
            $update_parcel->productPrice = 0;
            $update_parcel->cod = $request->cod;
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
        }
        return redirect()->back()->with('success', 'Thanks! your parcel update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Parcel::where('id', $id)->delete();

        return back()->with('success', 'Parcel Deleted Successfully');
    }

    // cancel
    public function parcelCancel($id)
    {
        $parcel = Parcel::find($id);
        if ($parcel->status < 2) {
            $parcel->cod = 0;
            $parcel->merchantAmount = 0;
            $parcel->merchantDue = 0;
            $parcel->deliveryCharge = 0;
            $parcel->codCharge = 0;
            $parcel->status = 9;
            $parcel->save();
        }
        $message = 'Parcel cancel successfully';

        return redirect()->back()->with('success', $message);
    }

    // import percel
    public function import(Request $request)
    {
        // return $request->all();
        $temp_files = [];
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $districts = District::orderBy('name')->where('status', 1)->get();
        $weights = Weight::where('status', 1)->get();
        if ($request->temp) {
            $temp_files = TempImportParecel::where('temp_no', $request->temp)->get();
            // return $temp_files;
        }

        return view('frontend.pages.merchant.percel.import', compact('temp_files', 'weights', 'districts', 'divisions'));
    }

    // importParcelRead
    public function importParcelRead(Request $request)
    {
        // return "Hi";

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

            return redirect()->route('merchant.percel.import', 'temp=' . '202');
        }
    }

    // import parcel
    public function importParcel(Request $request)
    {



        $length = count($request->productPrice);
        $count = 0;
        for ($i = 0; $i < $length; $i++) {
            $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();

            $thana_id = $request->thana_id[$i];

            // inside city list
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
            $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();

            if ($mercharntInfo->fixed_charge) {
                $delivery_charge = $mercharntInfo->fixed_charge;
                $codcharge = 0;
            }


            if (!empty($weight)) {

                // get deliverycharge
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
                $store_parcel->merchantId = Session::get('merchantId 
                
                ');
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
            } else {


                $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_delivery_charge_head_id])->first();

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
                $store_parcel->merchantId = Session::get('merchantId 
                
                ');
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
        }

        if ($count == $length) {
            TempImportParecel::where('temp_no', $request->temp)->delete();

            return back()->with('success', 'Percel Created Successfully');
        }
    }


    //invoice
    public function invoice($id)
    {
        $show_data = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->where('parcels.id', $id)
            ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.companyName', 'merchants.phoneNumber','merchants.otherphoneNumber', 'merchants.emailAddress')
            ->first();

            
        return view('frontend.pages.merchant.percel.invoice', compact('show_data'));
    }
}
