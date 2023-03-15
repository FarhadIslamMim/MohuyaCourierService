<?php

namespace App\Http\Middleware;

use App\Models\Deliveryman;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeliverymanMiddleware
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
        $validAgent = Deliveryman::where(['id' => Session::get('deliverymanId'), 'status' => 1])->first();
        if ($validAgent != null) {
            return $next($request);
        }

        return redirect()->route('signin')->with('error', 'Please login first');
        // return $next($request);
    }
}
