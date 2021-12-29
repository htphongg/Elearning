<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\ChiTietLopHoc;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SinhVienController extends Controller
{


    public function formQuenMatKhau()
    {
        return view('./login/forgot-password');
    }

    public function formCapNhatThongTinCaNhan()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./student/update-infor', ['ngDung' => $ngDung]);
        }
        // return view('./student/update-infor');
    }

    public function xuLyCapNhatThongTinCaNhan(Request $req)
    {
        $ngDung = NguoiDung::find($req->nguoi_dung_id);

        $ngDung->dia_chi = $req->address;
        $ngDung->email = $req->email;

        //Làm thế nào để kiểm tra email trùng nhau?
        $ngDung->save();

        return view('./student/update-infor', ['ngDung' => $ngDung]);
    }

    public function formDoiMatKhau()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./student/change-password', ['ngDung' => $ngDung]);
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

        return view('./student/change-password', ['ngDung' => $ngDung]);
    }

    public function layDsLop()
    {
        if (Auth::check()) {
            $nguoi_dung_id = Auth::id();
            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            return view('./student/index', compact('dsLop'));
        }
    }

    public function showChiTietLop(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/class', compact('lopHoc', 'dsLop'));
    }

    public function showCongViec(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/work', compact('lopHoc', 'dsLop'));
    }

    public function showTatCaThanhVien(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/everybody', compact('lopHoc', 'dsLop'));
    }



    public function thamGiaLop()
    {
        return view('./student/addclass');
    }
    public function xlthamGiaLop(Request $request)
    {
        $lop = LopHoc::where('ma_lop', '=', $request->codeclass)->first();
        $id = Auth::id();

        //Kt đã tham gia lớP đó chưa?
        //Kt nếu mã lớp kh tồn tại?

        $ctLopHoc = new ChiTietLopHoc();
        $ctLopHoc->lop_hoc_id = $lop->id;
        $ctLopHoc->nguoi_dung_id = $id;
        $ctLopHoc->save();

        return redirect()->route('sv-trang-chu');
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
}
