<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    public function handle($request, Closure $next){
        $url=$_SERVER['HTTP_REFERER'];
        $member =Session::get('member');

        if($member =='')
        {
            return redirect('/login?url='.urlencode($url));
        }

        return $next($request);
    }


}
