<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //change language
    public function langChange(Request $request)
    {
        App::setLocale($request->lang);
        Session::put('lang_code', $request->lang);

        return redirect()->back();
    }
}
