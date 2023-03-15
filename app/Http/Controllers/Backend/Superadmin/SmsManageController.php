<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Sms;
use Illuminate\Http\Request;

class SmsManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balances =  json_decode($this->smsBalance());
        $sms_balance  =  $balances->data->sms_limit;
        // $otp  = $this->getOTPBalance();
        $tempBalance = floor($sms_balance / 0.30);

        $sms_message = Sms::select('*')->orderBy('id', 'DESC')->get();
        // return $sms_message;
        return view('backend.pages.superadmin.sms.sms', compact('sms_message', 'tempBalance'));
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
        $setting = Setting::first();

        $this->validate(
            $request,
            [
                'phonenumber' => 'required',
                'sms' => 'required',
            ],
            [
                'phonenumber.required' => 'The Moblie Number is required. Please file up perfectly!',
                'sms.required' => 'Message Body is required. Please file up perfectly!',

            ]
        );
        $phone_number = explode(',', $request->phonenumber);
        foreach ($phone_number as $number) {
            $smsadd = new Sms();
            $smsadd->number = $number;
            $smsadd->sms = $request->sms . ' Regards,
                                 ' . $setting->name . ',
                                 ' . $setting->mobile_no . '';
            $smsadd->status = 0;
            $smsadd->save();
            if ($smsadd->id) {
                $number = $number;
                $msg = $request->sms . ' Regards,
                        ' . $setting->name . ',
                        ' . $setting->mobile_no . '';
                $send_sms = $this->sendSMS($number, $msg);
                if ($send_sms) {
                    Sms::where('id', $smsadd->id)->update(['status' => '1']);
                } else {
                    return back()->with('error', "Couldn't send the message, please contact with the developer");
                }
            }
        }

        return redirect()->back()->with('success', 'SMS sent successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $setting = Setting::first();
        $smsadd = Sms::find($id);
        if ($smsadd->number) {
            $number = '0' . $smsadd->number;
            $msg = "$smsadd->sms.
                        Regards,
                        $setting->name,
                        $setting->mobile_no";
            $send_sms = $this->sendSMS($number, $msg);
            if ($send_sms) {
                Sms::where('id', $id)->update(['status' => '1']);
            } else {
                return back()->with('error', "Couldn't send the message, please contact with the developer");
            }
        }

        return redirect()->back()->with('success', 'SMS sent successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $smsDelete = Sms::find($id);
        $deleted = $smsDelete->delete();

        return redirect()->back()->with('success', 'SMS delete successfully');
    }
}
