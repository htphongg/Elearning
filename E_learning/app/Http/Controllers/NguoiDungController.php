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

    
    //LONG

    // public function LayDSGV()
    // {
    //     $dsGV = NguoiDung::all()->where('loai_nguoi_dung_id', '2');
    //     return view('./layouts/admin/teacher/index', compact('dsGV'));
    // }
    // public function formThemMoi()
    // {
    //     return view('./layouts/admin/teacher/create');
    // }
    // public function xlThemMoi(Request $rq)
    // {
    //     $ngdung = new NguoiDung();
    //     $ngdung->ten_dang_nhap = $rq->ten_dang_nhap;
    //     $ngdung->password = $rq->password;
    //     $ngdung->ho_ten = $rq->ho_ten;
    //     $ngdung->ngay_sinh = $rq->ngay_sinh;
    //     if ($rq->gioi_tinh == "Nam") {
    //         $ngdung->gioi_tinh = $rq->gioi_tinh;
    //     } else if ($rq->gioi_tinh == "Nữ") {
    //         $ngdung->gioi_tinh = $rq->gioi_tinh;
    //     }
    //     $ngdung->dia_chi = $rq->dia_chi;
    //     $ngdung->sdt = $rq->sdt;
    //     $ngdung->email = $rq->email;
    //     $ngdung->loai_nguoi_dung_id = 2;
    //     $ngdung->save();
    //     return redirect()->route('ds_giang_vien');
    // }
}
