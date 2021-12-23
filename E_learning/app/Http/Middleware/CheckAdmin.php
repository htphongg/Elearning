<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if(Auth::user()->loai_nguoi_dung_id == 0)
            return $next($request);
        else if(Auth::user()->loai_nguoi_dung_id == 1)
            return redirect()->route('sv-trang-chu');
        else if(Auth::user()->loai_nguoi_dung_id == 2)
            return redirect()->route('trang-chu-giang-vien');
    }
}
