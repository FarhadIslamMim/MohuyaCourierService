<?php

namespace App\Providers;

use App\Models\Logo;
use App\Models\Parcel;
use App\Models\Parceltype;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // load logo
        $whitelogo = Logo::where('type', 1)->limit(1)->get();
        view()->share('whitelogo', $whitelogo);

        $darklogo = Logo::where('type', 2)->limit(1)->get();
        view()->share('darklogo', $darklogo);

        $faveicon = Logo::where('type', 3)->limit(1)->get();
        view()->share('faveicon', $faveicon);

        //load settings
        $setting = Setting::first();
        view()->share('setting', $setting);

        // // parcel types
        $perceltypes = Parceltype::get();
        view()->share('perceltypes', $perceltypes);

        // // Total Amount
        $totalamounts = Parcel::sum('merchantAmount');
        view()->share('totalamounts', $totalamounts);

        // // merchantdue
        $merchantsdue = Parcel::sum('merchantDue');
        view()->share('merchantsdue', $merchantsdue);

        // // today merchant due
        $todaymerchantsdue = Parcel::whereDate('created_at', Carbon::today())->sum('merchantDue');
        view()->share('todaymerchantsdue', $todaymerchantsdue);

        // // merchant paid amount
        $merchantspaid = Parcel::sum('collected_amount') - (Parcel::sum('deliveryCharge') + Parcel::sum('codCharge') + Parcel::sum('return_charge'));
        view()->share('merchantspaid', $merchantspaid);

        // bootstrap pagination
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);
    }
}
