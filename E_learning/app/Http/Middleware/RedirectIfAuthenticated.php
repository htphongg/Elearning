<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if(strcasecmp($user->loaiNguoiDung->ten_loai,'admin') == 0 )
                    return redirect()->route('trang-chu-admin');
                if(strcasecmp($user->loaiNguoiDung->ten_loai,'sinh viên') == 0 )
                    return redirect()->route('trang-chu-sinh-vien');
                if(strcasecmp($user->loaiNguoiDung->ten_loai,'giảng viên') == 0 )
                    return redirect()->route('trang-chu-giang-vien');
            }
        }
        return $next($request);
    }
}
