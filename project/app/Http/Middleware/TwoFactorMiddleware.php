<?php

namespace App\Http\Middleware;

use Closure;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorVarificationMail;
use Illuminate\Support\Facades\Session;

class TwoFactorMiddleware
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
        $user = Auth::guard('user')->user();

        if(!$user)
        {
            return redirect()->route('user.login.form');
        }
        
        if($user->isTwoFa == 0 || Session::has('2fa')){
            return $next($request);
        }
        
        if($user->isTwoFa == 1){
            Auth::guard('user')->user()->sendCode();
            return redirect()->route('user.twofa.form');
        }
    }
}
