<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
}
