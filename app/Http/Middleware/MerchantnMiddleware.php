<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MerchantnMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validMerchant = Merchant::where(['id' => Session::get('merchantId'), 'status' => 1])->first();
        if ($validMerchant != null && Session::get('merchantId')) {
            return $next($request);
        }

        return redirect()->route('signin')->with('error', 'Please login first');
    }
}
