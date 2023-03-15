<?php

namespace App\Http\Controllers;

use App\Models\Deliveryman;
use App\Models\Merchant;
use App\Models\Pickupman;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fileUpload($image, $path, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $imageUrl = $path . Str::random(50) . $image->getClientOriginalName();
        $img = Image::make($image);
        if ($width && $height) {
            $img->resize($width, $height);
        }
        $img->save($imageUrl);

        return $imageUrl;
    }

    public function fileUploadPHP($image, $path, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $name = Str::random(50) . $image->getClientOriginalName();
        $file = $image;
        $file->move($path, $name);
        $fileUrl = $path . $name;

        return $fileUrl;
    }

    public function sendSMS($number, $msg)
    {
        $apiKey = "175719284966750120230207110809pmzaTx4Vo3";
        $sender_id = 380;
        // $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        // $sender_id = 1498;
        $url = 'https://24bulksms.com/24bulksms/api/api-sms-send';
        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey,
            'mobileNo' => $number,
            'message' => $msg
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;

        // $apiKey = "2y10YPsOYoAA707dqKfiVseFfAEjW2khyaEEhW1b2g2dmFVIH5IKAa7813";
        // $sender_id = '8809612440815';
        // $url = 'http://portal.greenheritageit.com/smspanel/smsapi';
        // $data = array(
        //     'type' => 'text',
        //     'senderid' => $sender_id,
        //     'api_key' => $apiKey,
        //     'contacts' => $number,
        //     'msg' => $msg
        // );

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // $output = curl_exec($curl);
        // curl_close($curl);
        // return $output;
    }

    public function sendOTPSMS($number, $msg)
    {
        $apiKey = "C2001629629598d6e9b618.94751793";
        $sender_id = 8809612440996;
        $url = 'https://isms.zaman-it.com/smsapi';
        $data = array(
            'senderid' => $sender_id,
            'api_key' => $apiKey,
            'type' => $apiKey,
            'contacts' => $number,
            'msg' => $msg
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function getOTPBalance()
    {
        $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getBalance';
        // $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getDLR/getAll';
        $resp = $this->cURLGetRequest($url);
        return $resp;
    }

    public function getOTPDeliveryReport()
    {
        $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getDLR/getAll';
        $resp = $this->cURLGetRequest($url);
        return $resp;
    }

    function smsBalance()
    {
        $url = 'https://24smsbd.com/api/current-balance';
        // $apiKey = "T25lUG9pbnRJdFNvbHV0aW9uOlBvaW50ODUw";
        // $sender_id = 165;
        $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        $sender_id = 1498;

        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function merchant($api_token)
    {
        return Merchant::where('api_token', $api_token)->first();
    }

    public function deliveryman($api_token)
    {
        return Deliveryman::where('api_token', $api_token)->first();
    }

    public function pickupman($api_token = null)
    {
        return Pickupman::where('api_token', $api_token)->first();
    }

    public function cURLGetRequest($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }
}
