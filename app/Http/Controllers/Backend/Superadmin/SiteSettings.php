<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettings extends Controller
{
    // index
    public function siteSettings()
    {
        $setting = Setting::first();

        return view('backend.pages.superadmin.settings.sitesettings', compact('setting'));
    }

    public function siteSettingsUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'delivery_charge_amount_show' => 'required',
            'email' => 'nullable',
            'mobile_no' => 'nullable',
            'web' => 'nullable',
            'address' => 'nullable',
            'address_bn' => 'nullable',
            'facebook' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'google_plus' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'tracking_prefix' => 'nullable|max:10',
        ]);

        $store_data = Setting::first();
        if (empty($store_data)) {
            $store_data = new Setting();
        }

        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->mobile_no = $request->mobile_no;
        $store_data->web = $request->web;
        $store_data->address = $request->address;
        $store_data->address_bn = $request->address_bn ? $request->address_bn : '';
        $store_data->facebook = $request->facebook;
        $store_data->twitter = $request->twitter;
        $store_data->google_plus = $request->google_plus;
        $store_data->instagram = $request->instagram;
        $store_data->tracking_prefix = $request->tracking_prefix;
        $store_data->delivery_charge_amount_show = $request->delivery_charge_amount_show;
        if ($request->file('logo')) {
            if ($store_data->logo) {
                File::delete($store_data->logo);
            }
            $store_data->logo = $this->fileUpload($request->file('logo'), 'public/uploads/logo/');
        }
        $store_data->save();

        return redirect()->back()->with('success', 'Setting updated successfully');
    }
}
