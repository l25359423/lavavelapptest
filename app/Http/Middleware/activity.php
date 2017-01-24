<?php
namespace App\Http\Middleware;

use Closure;
class Activity{
    //前置
//    public function handle($request,Closure $next){
//        if( time() < strtotime('2017-01-09') ) {
//            return redirect('activity0');
//        }
//        return $next($request);
//    }

    //后置
    public function handle($request, Closure $next){
        $response = $next($request);
        echo "执行了后置操作";
        return $response;
    }
}