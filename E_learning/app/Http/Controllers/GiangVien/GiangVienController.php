<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Session;


class GiangVienController extends Controller
{
    public function layDsLop()
    {
        if (Auth::check()) {
            $nguoi_dung_id = Auth::id();
            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            return view('./teacher/index', compact('dsLop'));
        }
    }

    public function taoLop()
    {
        return view('./teacher/create-class');
    }

    public function formCapNhatThongTinCaNhan()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./teacher/update-infor', ['ngDung' => $ngDung]);
        }
        // return view('./teacher/update-infor');
    }

    public function xuLyCapNhatThongTinCaNhan(Request $req)
    {
        $ngDung = NguoiDung::find($req->nguoi_dung_id);

        $ngDung->dia_chi = $req->address;
        $ngDung->email = $req->email;

        //Làm thế nào để kiểm tra email trùng nhau?
        $ngDung->save();

        return view('./teacher/update-infor', ['ngDung' => $ngDung]);
    }

    public function formDoiMatKhau()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./teacher/change-password', ['ngDung' => $ngDung]);
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

        return view('./teacher/change-password', ['ngDung' => $ngDung]);
    }

    
    
    public function showChiTietLop(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./teacher/class', compact('lopHoc', 'dsLop'));
    }

    public function showCongViec(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./teacher/work', compact('lopHoc', 'dsLop'));
    }

    public function showTatCaThanhVien(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./teacher/everybody', compact('lopHoc', 'dsLop'));
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
}
