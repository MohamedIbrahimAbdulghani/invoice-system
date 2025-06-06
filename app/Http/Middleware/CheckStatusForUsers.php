<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckStatusForUsers
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
        $status = Auth::user()->status;
        Log::info("User status: $status");

            if ($status !== 'مفعل') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'حسابك غير مفعل، يرجى التواصل مع الدعم.'
                ]);
            }
        return $next($request);
    }
    
}