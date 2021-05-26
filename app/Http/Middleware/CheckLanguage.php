<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale_whitelist = ['it', 'en'];
        if($language_header = $request->header('Accept-Language')){
            in_array($language_header, $locale_whitelist) ? App::setLocale($language_header) : App::setLocale('en');
        } else {
            App::setLocale('en');
        }
        return $next($request);
    }
}
