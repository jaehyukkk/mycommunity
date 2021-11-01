<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LevelCheck
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
        if(Auth::user()){
            if(Auth::user()->level === 1){
                return $next($request);
            }
            else{
                return redirect('/')->with('alert','잘못된 접근입니다.');
            }
        }
        else{
            return redirect('/')->with('alert','잘못된 접근입니다.');
        }
        
    }
}