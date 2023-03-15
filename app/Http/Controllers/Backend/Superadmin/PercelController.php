<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Deliverycharge;
use App\Models\DeliveryChargeHead;
use App\Models\Deliveryman;
use App\Models\DeliverymanExtraWeight;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\Division;
use App\Models\Merchant;
use App\Models\MerchantExcludedWeights;
use App\Models\PackageExcludedWeights;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use App\Models\Pickupman;
use App\Models\PromotionalDiscount;
use App\Models\Setting;
use App\Models\Thana;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PercelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //load view
        $merchants = Merchant::verify()->orderBy('firstName')->get();
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $weights = Weight::where('status', 1)->get();

        return view('backend.pages.superadmin.percel.create', compact('merchants', 'weights', 'delivery_charge_heads', 'divisions', 'pickup_thanas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'merchantId' => 'required',
            'weight_id' => 'required|numeric',
            'name' => 'required',
            'phonenumber' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'delivery_address' => 'required',
        ]);
        $thana_id = Thana::find($request->thana_id);


        $mercharntInfo = Merchant::where('id', $request->merchantId)->first();

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
            $store_parcel->merchantId = $request->merchantId;
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
            $store_parcel->merchantId = $request->merchantId;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = Parcel::find($id);
        $merchants = Merchant::orderBy('id', 'DESC')->get();
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $weights = Weight::where('status', 1)->get();

        return view('backend.pages.superadmin.percel.edit', compact('edit_data', 'merchants', 'weights', 'delivery_charge_heads', 'divisions', 'pickup_thanas'));
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
            'merchantId' => 'required',
            'weight_id' => 'required|numeric',
            'name' => 'required',
            'phonenumber' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'delivery_address' => 'required',

        ]);

        $update_parcel = Parcel::find($request->hidden_id);
        $thana_id = Thana::find($update_parcel->thana_id);
        $mercharntInfo = Merchant::where('id', $update_parcel->merchantId)->first();


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
            $extra_weight = $weight->value - 1;
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
            $update_parcel->merchantId = $request->merchantId;
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
            $update_parcel->merchantId = $request->merchantId;
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


    public function destroy($id)
    {
        //
    }


    public function percel(Request $request)
    {
//        return "okk";

        $perceltype = Parceltype::where('slug', $request->slug)->first();
        $per_page = $request->per_page ?? 15;
        $divisions = Division::select('id', 'name')->get();
        $show_data = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('parcels.status', $perceltype->id);
        if ($request->trackId != null) {
            $show_data = $show_data->where('parcels.trackingCode', $request->trackId);
        }
        if ($request->merchantId != null) {
            $show_data->where('parcels.merchantId', $request->merchantId);
        }
        if ($request->companyname != null) {
            $show_data = $show_data->where('merchants.companyName', 'like', '%' . $request->companyname . '%');
        }
        if ($request->phoneNumber != null) {
            $show_data = $show_data->where('parcels.recipientPhone', $request->phoneNumber);
        }
        if ($request->thana_id != null) {
            $show_data = $show_data->where('parcels.thana_id', $request->thana_id);
        }
        if ($request->startDate != null && $request->endDate != null) {
            $show_data = $show_data->whereDate('parcels.created_at', '>=', $request->startDate)
                ->whereDate('parcels.created_at', '<=', $request->endDate);
        }

        if ($request->startDate != null && $request->endDate == null && $request->trackId == null && $request->companyname == null && $request->phoneNumber == null) {
            $show_data = $show_data->whereDate('parcels.created_at', '=', $request->startDate);
            // ->whereDate('parcels.created_at', '<=', $request->endDate);
        }

        if ($request->startDate != null && $request->endDate != null && $request->trackId == null && $request->companyname == null && $request->phoneNumber == null) {
            $show_data = $show_data->whereDate('parcels.created_at', '>=', $request->startDate)
                ->whereDate('parcels.created_at', '<=', $request->endDate);
        }

        $show_data = $show_data->orderBy('created_at', 'DESC')
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid');

        if ($per_page == 'all') {
            $show_data = $show_data->latest()->get();
        } else {
            $show_data = $show_data->paginate($per_page);
        }

        // dd($show_data);

        $merchants = Merchant::where('status', 1)->verify()->get();

        return view('backend.pages.superadmin.percel.manage', compact('show_data', 'perceltype', 'merchants', 'divisions'));
    }

    // select update
    public function selectUpdate(Request $request)
    {
        // return $request->all();

        $setting = Setting::first();


        $selectLength = ($request->parcel_select) ? count($request->parcel_select) : 0;

        if ($request->updstatus && $selectLength > 0) {

            // return "hi";

            $totalSuccess = 0;
            foreach ($request->parcel_select as $parcelId) {
                $parcel = Parcel::find($parcelId);
                $merchantinfo = Merchant::find($parcel->merchantId);
                $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
                $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();
                $agentInfo = Agent::where(['id' => $parcel->agentId])->first();

                // return $agentInfo;

                if ($request->updstatus == 1) {
                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                } elseif ($request->updstatus == 2) {
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
                        " . $setting->name . "";
                        $this->sendSMS($numbers, $msg);
                    }

                    // Send Customer message
                    if ($parcel->recipientPhone) {
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID <a href='https://demo.sensorbd.com/parcel-tracking?tracking_id=$parcel->trackingCode'>$parcel->trackingCode</a> for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n " . $setting->name . " ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }
                } elseif ($request->updstatus == 3) {

                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                } elseif ($request->updstatus == 5) {
                    if ($deliverymanInfo) {
                        // Send Customer message
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n " . $setting->name . " ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }
                } elseif ($request->updstatus == 6) {
                    if ($deliverymanInfo) {
                        // Send Customer message
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n " . $setting->name . " ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }
                } elseif ($request->updstatus == 7) {

                    if ($parcel->updstatus < 7) {
                        $parcel->cod = $parcel->cod;
                        $parcel->merchantAmount = $parcel->merchantAmount;
                        $parcel->merchantDue = $parcel->merchantDue;
                        $parcel->deliveryCharge = $parcel->deliveryCharge;
                        $parcel->codCharge = $parcel->codCharge;
                    }
                } elseif ($request->updstatus == 9) {
                    if ($parcel->updstatus < 2) {
                        $parcel->cod = 0;
                        $parcel->merchantAmount = 0;
                        $parcel->merchantDue = 0;
                        $parcel->deliveryCharge = 0;
                        $parcel->codCharge = 0;
                    }
                } else {

                    $thana = Thana::find($parcel->thana_id);
                    $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();
                    $return_charge =  $parcel->deliveryCharge * $deliveryChargeInfo->return_charge / 100;
                    $parcel->return_charge = $return_charge;


                    $inside_city = $merchantinfo->inside_city ?? 0;
                    $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana->id)->get();


                    // get subcity list
                    $sub_city = $merchantinfo->sub_city ?? 0;
                    $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana->id)->get();

                    // get outside list
                    $district_id = $request->district_id;
                    $outside_city = $merchantinfo->outside_city ?? 0;
                    $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


                    if (count($get_packages_inside_city) > 0) {
                        $package = DeliveryPackage::where('id', $inside_city)->first();
                        $return_charge = $parcel->deliveryCharge * $package->return_charge / 100;
                        $parcel->return_charge = $return_charge;
                    }

                    if (count($get_packages_sub_city) > 0) {
                        $package = DeliveryPackage::where('id', $sub_city)->first();
                        $return_charge = $parcel->deliveryCharge * $package->return_charge / 100;
                        $parcel->return_charge = $return_charge;
                    }

                    if (count($get_packages_outside_city) > 0) {
                        $package = DeliveryPackage::where('id', $outside_city)->first();
                        $return_charge = $parcel->deliveryCharge * $package->return_charge / 100;
                        $parcel->return_charge = $return_charge;
                    }




                    // Send Merchant message
                    $numbers = '0' . $merchantinfo->phoneNumber;

                    $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is RETURN. \r\n Regards,\r\n " . $setting->name . "";
                    $this->sendSMS($numbers, $msg);

                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                    // $parcel->cod = 0;
                    $parcel->codCharge = 0;
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                }

                $parcel->status = $request->updstatus;
                $parcel->save();

                $pnote = Parceltype::find($request->updstatus);

                $note = new Parcelnote();
                $note->parcelId = $parcelId;
                $note->note = 'Your parcel ' . $pnote->title;
                $note->save();

                if ($request->updstatus == 8) {

                    // return "hi";

                    $notes = new Parcelnote();

                    $notes->parcelId = $parcelId;
                    $notes->note = $parcel->deliveryman_note;
                    $notes->save();
                }

                $totalSuccess += 1;
            }

            return redirect()->back()->with('success', 'Parcel Status updated successfully');
        } else {
            return redirect()->back()->with('error', 'Please ensure that you have select any record!');
        }
    }

    //multiple deliveryman assign
    public function deliverymanAssignMultiple(Request $request)
    {
        $request->validate([
            'parcel_select' => 'required',
            'deliveryman_assign_id' => 'required',
        ]);

        if ($request->parcel_select) {
            foreach ($request->parcel_select as $parcelid) {
                $parcel = Parcel::find($parcelid);
                $parcel->deliverymanId = $request->deliveryman_assign_id;
                $parcel->save();

                $deliveryman = Deliveryman::find($request->deliveryman_assign_id);
                $note = new Parcelnote();
                $note->parcelId = $parcelid;
                $note->note = 'Deliveryman Asign';
                $note->remark = $deliveryman->name . ' - ' . $deliveryman->phone;
                $note->save();
            }

            return redirect()->back()->with('success', 'Deliveryman assigned successfully');
        } else {
            return redirect()->back()->with('error', 'Select at least one percel');
        }
    }

    //multiple pickupman assign
    public function pickupmanAssignMultiple(Request $request)
    {
        $request->validate([
            'parcel_select' => 'required',
            'pickupman_assign_id' => 'required',
        ]);

        if ($request->parcel_select) {
            foreach ($request->parcel_select as $parcelid) {
                $parcel = Parcel::find($parcelid);
                $parcel->pickupmanId = $request->pickupman_assign_id;
                $parcel->save();

                $pickupman = Pickupman::find($request->pickupman_assign_id);
                $note = new Parcelnote();
                $note->parcelId = $parcelid;
                $note->note = 'Pickupman Asign';
                $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
                $note->save();
            }

            return redirect()->back()->with('success', 'Pickupman assign successful');
        } else {
            return redirect()->back()->with('error', 'Select pickupman');
        }
    }

    //multiple pickupman assign
    public function agentAssignMultiple(Request $request)
    {
        $request->validate([
            'parcel_select' => 'required',
            'agent_assign_id' => 'required',
        ]);

        if ($request->parcel_select) {
            foreach ($request->parcel_select as $parcelid) {
                $parcel = Parcel::find($parcelid);
                $parcel->agentId = $request->agent_assign_id;
                $parcel->save();

                $agentInfo = Agent::find($request->agent_assign_id);
                $note = new Parcelnote();
                $note->parcelId = $parcelid;
                $note->note = 'Agent Asign';
                $note->remark = $agentInfo->name . ' - ' . $agentInfo->phone;
                $note->save();
            }

            return redirect()->back()->with('success', 'Agent assign successful');
        } else {
            return redirect()->back()->with('error', 'Select atleast one percel');
        }
    }

    // generate multi lebel
    public function generateMultiLabel(Request $request)
    {
        $request->validate([
            'parcel_select' => 'required',
        ]);
        $parcelList = $request->parcel_select;
        $site_settings = Setting::first();

        return view('backend.pages.superadmin.percel.generatemulti_label', compact('parcelList', 'site_settings'));
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
            ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();

        return view('backend.pages.superadmin.percel.new_invoice', compact('show_data'));
    }

    // deliveryman assign
    public function deliverymanAssign(Request $request)
    {
        $this->validate($request, [
            'deliverymanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->deliverymanId = $request->deliverymanId;
        $parcel->save();

        $deliveryman = Deliveryman::find($request->deliverymanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = 'Deliveryman Asign';
        $note->remark = $deliveryman->name . ' - ' . $deliveryman->phone;
        $note->save();

        return redirect()->back()->with('success', 'Deliveryman assign successfully');
    }

    // pickupman assign
    public function pickupmanAssign(Request $request)
    {
        $this->validate($request, [
            'pickupmanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->pickupmanId = $request->pickupmanId;
        $parcel->save();

        $pickupman = Pickupman::find($request->pickupmanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = 'Pickupman Asign';
        $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
        $note->save();

        return redirect()->back()->with('success', 'Pickupman assign successfully');
    }

    // agent assign
    public function agentAssign(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'agentId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->agentId = $request->agentId;
        $parcel->save();

        $agentInfo = Agent::find($request->agentId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = 'Agent Asign';
        $note->remark = $agentInfo->name . ' - ' . $agentInfo->phone;
        $note->save();

        return redirect()->back()->with('success', 'Agent assign successfully');
    }

    // generate label
    public function generateLabel($id)
    {
        $show_data = Parcel::find($id);

        return view('backend.pages.superadmin.percel.lable', compact('show_data'));
    }

    // partial return
    public function partialReturn(Request $request)
    {
        $this->validate($request, [
            'parcel_id' => 'required',
            'partial_return_amount' => 'required|numeric',
        ]);
        $parcel = Parcel::find($request->parcel_id);
        $old_amount = $parcel->partial_return_amount ?? 0;
        $parcel->partial_return_amount = $old_amount + $request->partial_return_amount;
        $parcel->partial_return_note = $request->partial_return_note;
        $parcel->merchantAmount = $parcel->cod - ($parcel->deliveryCharge + $parcel->codCharge + $parcel->partial_return_amount);
        $parcel->save();

        return back()->with('success', 'Partial return successfully!');
    }

    // import
    public function deliveryStatus(Request $request)
    {
        // return $request->all();
        $percelId = $request->hidden_id;
        $parcel = Parcel::find($percelId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
        $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();
        $agentInfo = Agent::where(['id' => $parcel->agentId])->first();


        // return $request->all();

        if ($request->updstatus_delivery == 4) {
            // return "hi";
            $totalSuccess = 0;
            $setting = Setting::first();

            $inside_city = $merchantinfo->inside_city;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $parcel->thana->id)->get();


            // get subcity list
            $sub_city = $merchantinfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $parcel->thana->id)->get();

            // get outside list
            $district_id = $request->district_id;
            $outside_city = $merchantinfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $parcel->district->id)->get();
            $parcel->merchantAmount = ($request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge);

            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
            $parcel->merchantDue = $parcel->merchantAmount;

            if ($get_packages_inside_city) {
                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                // $parcel->save();
            }

            if ($get_packages_sub_city) {


                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                // $parcel->save();
            }

            if ($get_packages_outside_city) {
                $total_amount = $request->collected_amount - $parcel->deliveryCharge - $parcel->codCharge;
                $parcel->merchantAmount = $total_amount;
                $parcel->merchantDue = $total_amount;
                // $parcel->save();
            }

            $parcel->delivery_date = now();
            if ($deliverymanInfo) {

                // return $parcel->productWeight;
                $delivery_weights = DeliverymanExtraWeight::where('deliveryman_id', $deliverymanInfo->id)->select('weight_id')->pluck('weight_id')->toArray();
                // return $delivery_weights;
                $weights =  array_search($parcel->productWeight, $delivery_weights);
                if ($weights) {

                    $total_weight = $weights + 1;
                    $parcel->deliveryman_amount =  $total_weight * $deliverymanInfo->extra_weight_charge + $deliverymanInfo->per_parcel_amount;
                    $parcel->deliveryman_paid = 0;
                    $parcel->deliveryman_due = $total_weight * $deliverymanInfo->extra_weight_charge + $deliverymanInfo->per_parcel_amount;
                } else {
                    $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                    $parcel->deliveryman_paid = 0;
                    $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
                }
            }
            $parcel->collected_amount = $request->collected_amount;
            $parcel->deliveryman_note = $request->deliveryman_note;
            $parcel->status = $request->updstatus_delivery;
            $parcel->save();
            // $parcel->save();
            $validMerchant = Merchant::find($parcel->merchantId);

            // Sens Merchant message
            $numbers = '0' . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n " . $setting->name . "";
            $this->sendSMS($numbers, $msg);

            // Sens Customer message
            $customer_numbers = $parcel->recipientPhone;
            $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is on Deliverd. \r\n Regards,\r\n " . $setting->name . " ";
            $this->sendSMS($customer_numbers, $customer_msg);

            

            $pnote = Parceltype::find($request->updstatus_delivery);
            $note = new Parcelnote();
            $note->parcelId = $percelId;
            $note->note = 'Your parcel ' . $pnote->title;
            $note->save();

            $totalSuccess += 1;

            return back()->with('success', "Percel Delivered Successfully");
        }
    }
}
