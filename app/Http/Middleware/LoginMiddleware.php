<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //数据过滤 $request 请求报文
    public function handle($request, Closure $next)
    {
        //判断当前是否具有用户登录session id
        if($request->session()->has('id')){
            //执行下一个请求
             return $next($request);
        }else{
            //跳转到登录界面
            return redirect("/login");
        }
       
    }
}
