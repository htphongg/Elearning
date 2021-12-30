<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\LopHoc;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DangNhapRequest;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Session;
// use App\Http\Requests\CapNhatThongTinCaNhanRequest;


class NguoiDungController extends Controller
{
    public function formDangNhap()
    {
        return view('index');
    }

    public function xuLyDangNhap(DangNhapRequest $request)
    {
        if (Auth::attempt(['ten_dang_nhap' => $request->username, 'password' => $request->password])) {
            $infor = Auth::user();
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'admin') == 0) {
                // $request->session()->flash('signin', true);
                return redirect()->route('ad-trang-chu');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'sinh viên') == 0) {
                // $request->session()->flash('signin', true);
                return redirect()->route('sv-trang-chu');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'giảng viên') == 0) {
                // $request->session()->flash('signin', true);
                return redirect()->route('gv-trang-chu');
            }
        } else {
            $request->session()->flash('error', 'Sai tên tài khoản hoặc mật khẩu');
            return redirect()->route('dang-nhap');
        }
    }
}
