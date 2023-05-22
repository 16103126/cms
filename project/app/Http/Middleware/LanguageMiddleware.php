<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
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
        if(\Request::is('admin*'))
        {
            $language = DB::table('admin_languages')->where('isDefault', 1)->first();
            if($language){
                App::setLocale($language->name);
            }
        }else{
            if(Session::has('language')){
                $language = DB::table('website_languages')->find(Session::get('language'));
                App::setLocale($language->name);
            }else{
                $language = DB::table('website_languages')->where('isDefault', 1)->first();
                App::setLocale($language->name);
            }
        }
        return $next($request);
    }
}
