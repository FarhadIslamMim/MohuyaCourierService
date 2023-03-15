<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentThana;
use App\Models\Area;
use App\Models\Deliverycharge;
use App\Models\Deliveryman;
use App\Models\DeliveryPacakageDistrict;
use App\Models\DeliveryPackage;
use App\Models\DeliveryPackageArea;
use App\Models\District;
use App\Models\Merchant;
use App\Models\MerchantExcludedWeights;
use App\Models\PackageExcludedWeights;
use App\Models\Parcel;
use App\Models\Pickupman;
use App\Models\PromotionalDiscount;
use App\Models\Thana;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function getAreaAddress(Request $request)
    {
        $address = [];
        if ($request->area_id) {
            $address = Parcel::where('area_id', $request->area_id)->distinct('delivery_address')->select('delivery_address')->take(200)->get();
        }

        return response()->json($address);
    }

    // get disctrict
    public function getDivisionDistricts(Request $request)
    {
        $districts = District::orderBy('name')->where('division_id', $request->division_id)->where('status', 1)->get();

        return response()->json($districts);
    }

    // get district thanas
    public function getDistrictThanas(Request $request)
    {
        $thanas = Thana::orderBy('name')->where('district_id', $request->district_id)->where('status', 1)->orderBy('name', 'ASC')->get();

        return response()->json($thanas);
    }

    // get district agents
    public function getDistrictAgents(Request $request)
    {
        $agent_ids = AgentThana::where('district_id', $request->district_id)->distinct('agent_id')->pluck('agent_id');
        $agents = Agent::orderBy('name')->whereIn('id', $agent_ids)->where('status', 1)->get();

        return response()->json($agents);
    }

    // thana areas
    public function getThanaAreasFinal(Request $request)
    {
        $areas = Area::where('thana_id', $request->thana_id)->where('status', 1)->orderBy('name', 'ASC')->get();
        return response()->json($areas);
    }

    public function getThanaAreas(Request $request)
    {
        $areas = Thana::where('district_id', $request->district_id)->where('status', 1)->get();

        return response()->json($areas);
    }

    // agent areas
    public function getAgentAreas(Request $request)
    {
        $thana_ids = AgentThana::whereIn('agent_id', $request->agent_id)->distinct('thana_id')->pluck('thana_id');
        $areas = Area::with('thana')->orderBy('name')->whereIn('thana_id', $thana_ids)->where('status', 1)->get();

        return response()->json($areas);
    }


    // agent thanas
    public function getAgentThanas(Request $request)
    {
        $thana_ids = AgentThana::where('agent_id', $request->id)->pluck('thana_id')->toArray();
        $thanas = Thana::orderBy('name')->whereIn('id', $thana_ids)->where('status', 1)->get();
        // return $thanas;
        // $areas = Area::with('thana')->orderBy('name')->whereIn('thana_id', $thana_ids)->where('status', 1)->get();

        return response()->json($thanas);
    }


    /**
     * Method getThanaDeliverymenPickupman
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getThanaDeliverymenPickupman(Request $request)
    {
        $deliverymens = Deliveryman::where('thana_id', $request->thana_id)->where('status', 1)->get();
        $pickupmans = Pickupman::where('thana_id', $request->thana_id)->where('status', 1)->get();
        $data = [
            'deliverymens' => $deliverymens,
            'pickupmans' => $pickupmans,
        ];

        return response()->json($data);
    }


    /**
     * Method getMerchantDetails
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function getMerchantDetails(Request $request)
    {
        $data = Merchant::find($request->merchantId);

        return response()->json($data);
    }


    /**
     * Method costCalculate
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function costCalculate(Request $request)
    {

        if ($request->merchantId) {
            $mercharntInfo = Merchant::where('id', $request->merchantId)->first();
        } else {
            $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();
        }


        $thana = Thana::find($request->thana_id);
        $division = $request->division_id;
        $district = $request->district_id;
        $thana_id = $request->thana_id;


        $inside_city = $mercharntInfo->inside_city;
        $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id)->get();

        // get subcity list
        $sub_city = $mercharntInfo->sub_city;
        $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id)->get();

        // get outside list
        $district_id = $request->district_id;

        $outside_city = $mercharntInfo->outside_city;
        $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


        $excluded_weights = [];
        $excluded_weights_last_id = 0;

        if (count($get_packages_inside_city) > 0) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->inside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }
        if (count($get_packages_sub_city)) {

            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->sub_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }
        if (count($get_packages_outside_city)) {
            $excluded_weights = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id');
            $excluded_weights_last_id = PackageExcludedWeights::where('package_id', $mercharntInfo->outside_city)->orderBy('weight_id', 'DESC')->pluck('weight_id')->first();
        }



        $weight = Weight::where('id', $request->weight_id)->whereNotIn('id', $excluded_weights)->first();
        $weight_last_value = Weight::where('id', $excluded_weights_last_id)->first();

        $last_extra_weight = $weight_last_value->extra_weight ?? 0;

        if (empty($thana->deliverycharge_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Your selected thana is disabled.',
            ]);
        }




        if (!empty($weight)) {


            $delivery_charge = [];

            if (count($get_packages_inside_city) > 0) {
                $package = DeliveryPackage::where('id', $inside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;

                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }
            if (count($get_packages_sub_city) > 0) {

                $package = DeliveryPackage::where('id', $sub_city)->first();
                // return $package; 
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;

                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }
            if (count($get_packages_outside_city) > 0) {
                $package = DeliveryPackage::where('id', $outside_city)->first();
                $extra_weight = $weight->extra_weight - $last_extra_weight;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }

            $extra_weight = $weight->extra_weight - 0;

            // return $weight;
            // get deliverycharge
            // return $thana->deliverycharge_id;
            $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();

            // return $deliveryChargeInfo;





            if ($mercharntInfo->fixed_charge) {
                $delivery_charge = $mercharntInfo->fixed_charge;
                $codcharge = 0;
            }

            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

            // Extra charge
            // return $weight;

            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);



            // Promotional discount
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
            return response()->json([
                'success' => true,
                'codpay' => $request->productPrice,
                'pdeliverycharge' => number_format($delivery_charge, 2),
                'pcodecharge' => number_format($codcharge, 2),
                'total_charge' => number_format(($delivery_charge + $codcharge), 2),
                'pay_to_merchant' => number_format($request->productPrice - ($delivery_charge + $codcharge), 2),
                'promotiuonal_discount' => number_format(($promotiuonal_discount), 2),
            ]);
        } else {


            $inside_city = $mercharntInfo->inside_city;
            $get_packages_inside_city = DeliveryPackageArea::where('delivery_package_id', $inside_city)->where('delivery_thanas', $thana_id)->get();

            // get subcity list
            $sub_city = $mercharntInfo->sub_city;
            $get_packages_sub_city = DeliveryPackageArea::where('delivery_package_id', $sub_city)->where('delivery_thanas', $thana_id)->get();



            // get outside list
            $district_id = $request->district_id;

            $outside_city = $mercharntInfo->outside_city;
            $get_packages_outside_city = DeliveryPacakageDistrict::where('package_id', $outside_city)->where('district_id', $district_id)->get();


            $delivery_charge = [];

            if (count($get_packages_inside_city) > 0) {

                $package = DeliveryPackage::where('id', $inside_city)->first();
                $extra_weight = 0;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;
                // return $total_charge;
                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }
            if (count($get_packages_sub_city) > 0) {

                $package = DeliveryPackage::where('id', $sub_city)->first();

                $extra_weight = 0;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;


                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }
            if (count($get_packages_outside_city) > 0) {
                $package = DeliveryPackage::where('id', $outside_city)->first();
                $extra_weight = 0;
                $total_charge = $package->delivery_charge + ($extra_weight * $package->extra_delivery_charge) + $request->productPrice * $package->cod_charge / 100;

                return response()->json([
                    'success' => true,
                    'codpay' => $request->productPrice,
                    'pdeliverycharge' => number_format($package->delivery_charge + ($extra_weight * $package->extra_delivery_charge), 2),
                    'pcodecharge' => number_format($request->productPrice * $package->cod_charge / 100, 2),
                    'total_charge' => number_format($total_charge, 2),
                    'pay_to_merchant' => number_format($request->productPrice - $total_charge, 2),
                ]);
            }


            $delivery_charge = [];

            // get deliverycharge
            $deliveryChargeInfo = Deliverycharge::where(['delivery_charge_head_id' => $thana->deliverycharge_id])->first();



            if ($mercharntInfo->fixed_charge) {
                $delivery_charge = $mercharntInfo->fixed_charge;
                $codcharge = 0;
            }

            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

            // Extra charge
            // return $weight;
            $extra_weight = $weight->value - 1;


            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

            // return $delivery_charge;
            // Promotional discount
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

            return response()->json([
                'success' => true,
                'codpay' => $request->productPrice,
                'pdeliverycharge' => number_format($delivery_charge, 2),
                'pcodecharge' => number_format($codcharge, 2),
                'total_charge' => number_format(($delivery_charge + $codcharge), 2),
                'pay_to_merchant' => number_format($request->productPrice - ($delivery_charge + $codcharge), 2),
                'promotiuonal_discount' => number_format(($promotiuonal_discount), 2),
            ]);
        }
    }
}
