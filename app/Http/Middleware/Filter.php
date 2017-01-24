<?php
namespace App\Http\Middleware;

use Closure;
class Filter{
    public function handle($request,Closure $next) {
        echo "我是公共过滤器";
        return $next($request);
    }
}