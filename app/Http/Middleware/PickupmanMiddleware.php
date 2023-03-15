<?php

namespace App\Http\Middleware;

use App\Models\Pickupman;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PickupmanMiddleware
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
        $validAgent = Pickupman::where(['id' => Session::get('pickupmanId'), 'status' => 1])->first();
        if ($validAgent != null) {
            return $next($request);
        }

        return redirect()->route('signin')->with('error', 'Please login first');
    }
}
