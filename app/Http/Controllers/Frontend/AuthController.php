<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Deliveryman;
use App\Models\Merchant;
use App\Models\Pickupman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function authCheck(Request $request)
    {
        if ($request->role == 1) {
            $this->validate($request, [
                'users' => 'required',
                'password' => 'required',
            ]);

            $merchantChedk = Merchant::where('phoneNumber', $request->users)
                ->orWhere('emailAddress', $request->users)
                ->first();
            // dd($merchantChedk);
            if ($merchantChedk) {
                if ($merchantChedk->status == 0 || $merchantChedk->verify == 0) {
                    return redirect()->back()->withInput()->with('error', 'Opps! your account has been review');
                } elseif ($merchantChedk->verify != 1) {
                    Session::put('initmerchantId', $merchantChedk->id);

                    return redirect('merchant/verify')->with('error', 'Please verify your account');
                } else {
                    if (password_verify($request->password, $merchantChedk->password)) {
                        $merchantId = $merchantChedk->id;
                        Session::put('merchantId', $merchantId);
                        Session::put('LAST_ACTIVITY', time());

                        return redirect()->route('merchant.home')->with('success', 'Welcome merchant');
                    } else {
                        return redirect()->back()->with('error', 'Sorry! your password wrong');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Opps! you have no account');
            }
        } elseif ($request->role == 2) {
            $this->validate($request, [
                'users' => 'required',
                'password' => 'required',
            ]);
            $checkAuth = Deliveryman::where('email', $request->users)
                ->orWhere('phone', $request->users)
                ->first();
            if ($checkAuth) {
                if ($checkAuth->status == 0) {
                    return redirect()->back()->with('error', 'Opps! your account has been suspends');
                } else {
                    if (password_verify($request->password, $checkAuth->password)) {
                        $deliverymanId = $checkAuth->id;
                        Session::put('deliverymanId', $deliverymanId);

                        return redirect()->route('deliveryman.home');
                    } else {
                        return redirect()->back()->with('error', 'Sorry! your password is wrong');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Opps! you have no account');
            }
        } elseif ($request->role == 3) {
            $this->validate($request, [
                'users' => 'required',
                'password' => 'required',
            ]);
            $checkAuth = Pickupman::where('email', $request->users)
                ->orWhere('phone', $request->users)
                ->first();
            if ($checkAuth) {
                if ($checkAuth->status == 0) {
                    return redirect()->back()->with('error', 'Opps! your account has been suspends');
                } else {
                    if (password_verify($request->password, $checkAuth->password)) {
                        $pickupmanId = $checkAuth->id;
                        Session::put('pickupmanId', $pickupmanId);

                        return redirect()->route('pickupman.home');
                    } else {
                        return redirect()->back()->with('error', 'Sorry! your password is wrong');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Opps! you have no account');
            }
        } elseif ($request->role == 4) {
            $this->validate($request, [
                'users' => 'required',
                'password' => 'required',
            ]);
            $checkAuth = Agent::where('email', $request->users)
                ->orWhere('phone', $request->users)
                ->first();
            if ($checkAuth) {
                if ($checkAuth->status == 0) {
                    return redirect()->back()->with('error', 'Opps! your account has been suspends');
                } else {
                    if (password_verify($request->password, $checkAuth->password)) {
                        $agentId = $checkAuth->id;
                        Session::put('agentId', $agentId);

                        return redirect()->route('agent.home');
                    } else {
                        return redirect()->back()->with('error', 'Sorry! your password is wrong');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Opps! you have no account');
            }
        } else {
            return back()->with('error', 'Please select your role first');
        }
    }

    // signout
    public function signout()
    {
        Session::flush();

        return redirect()->route('signin')->with('success', 'You have successfully signed out');
    }
}
