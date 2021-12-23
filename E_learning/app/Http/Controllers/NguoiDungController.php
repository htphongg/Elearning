<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
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
                return redirect()->route('trang-chu-admin');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'sinh viên') == 0) {
                // $request->session()->flash('signin', true);
                return redirect()->route('trang-chu-sinh-vien');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'giảng viên') == 0) {
                // $request->session()->flash('signin', true);
                return redirect()->route('trang-chu-giang-vien');
            }
        } else {
            $request->session()->flash('error', 'Sai tên tài khoản hoặc mật khẩu');
            return redirect()->route('dang-nhap');
        }
    }

    public function formQuenMatKhau()
    {
        return view('./layouts/login/forgot-password');
    }

    //Sinh viên
    public function formCapNhatThongTinCaNhan()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./layouts/student/update-infor', ['ngDung' => $ngDung]);
        }
        // return view('./layouts/student/update-infor');
    }

    public function xuLyCapNhatThongTinCaNhan(Request $req)
    {
        $ngDung = NguoiDung::find($req->nguoi_dung_id);

        $ngDung->dia_chi = $req->address;
        $ngDung->email = $req->email;

        //Làm thế nào để kiểm tra email trùng nhau?
        $ngDung->save();

        return view('./layouts/student/update-infor', ['ngDung' => $ngDung]);
    }

    public function formDoiMatKhau()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./layouts/student/change-password', ['ngDung' => $ngDung]);
        }
    }

    public function xuLyDoiMatKhau(Request $req)
    {
        $ngDung = NguoiDung::find($req->nguoi_dung_id);

        if (Hash::check($req->old_password, $ngDung->password)) {
            if (strcmp($req->new_password, $req->cf_new_password) == 0) {
                $ngDung->password = Hash::make($req->new_password);
                $ngDung->save();
                Auth::logout();
                return redirect()->route('dang-nhap');
            } else
                echo "Xác nhận mật khẩu mới không hợp lệ";
        } else
            echo "Mật khẩu cũ không hợp lệ";

        return view('./layouts/student/change-password', ['ngDung' => $ngDung]);
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
    //LONG

    public function LayDSGV()
    {
        $dsGV = NguoiDung::all()->where('loai_nguoi_dung_id', '2');
        return view('./layouts/admin/teacher/index', compact('dsGV'));
    }
    public function formThemMoi()
    {
        return view('./layouts/admin/teacher/create');
    }
    public function xlThemMoi(Request $rq)
    {
        $ngdung = new NguoiDung();
        $ngdung->ten_dang_nhap = $rq->ten_dang_nhap;
        $ngdung->password = $rq->password;
        $ngdung->ho_ten = $rq->ho_ten;
        $ngdung->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam") {
            $ngdung->gioi_tinh = $rq->gioi_tinh;
        } else if ($rq->gioi_tinh == "Nữ") {
            $ngdung->gioi_tinh = $rq->gioi_tinh;
        }
        $ngdung->dia_chi = $rq->dia_chi;
        $ngdung->sdt = $rq->sdt;
        $ngdung->email = $rq->email;
        $ngdung->loai_nguoi_dung_id = 2;
        $ngdung->save();
        return redirect()->route('ds_giang_vien');
    }
}
