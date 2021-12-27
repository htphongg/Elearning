<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\lopHoc;
use App\Models\PhongChoLopHoc;
use App\Models\ChiTietLopHoc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CapNhatThongTinCaNhanRequest;


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

    public function xlTaoLop(Request $req)
    {
        if($req->ten_lop != "" || $req->mo_ta !="")
        {
            $lopHoc = new LopHoc();

            $lopHoc->ma_lop = Str::random(6);
            $lopHoc->ten_lop = $req->ten_lop;
            $lopHoc->mo_ta = $req->mo_ta;
            $lopHoc->anh_nen_id = 1;
            $lopHoc->save();

            $ctLopHoc = new ChiTietLopHoc();
            $ctLopHoc->lop_hoc_id = $lopHoc->id;
            $ctLopHoc->nguoi_dung_id = Auth::id();
            $ctLopHoc->save();

            return redirect()->route('gv-trang-chu');
        }
        else
            return redirect()->route('gv-tao-lop');
    }

    public function chinhSuaLop(Request $req)
    {   
        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./teacher/edit-class',compact('lopHoc'));
    }

    public function xlChinhSuaLop(Request $req)
    {
        if($req->lop_hoc_id != "" || $req->mo_ta != "")
        {
            $lopHoc = LopHoc::find($req->lop_hoc_id);

            $lopHoc->mo_ta = $req->mo_ta;
    
            $lopHoc->save();

            return redirect()->route('gv-trang-chu')->with('success','Chỉnh sửa thành công');
        }
        return redirect()->route('gv-xl-chinh-sua-lop',['lop_hoc_id' =>  $req->lop_hoc_id ])->with('error','Chỉnh sửa thất bại');
    }

    public function xoaLopHoc(Request $req)
    {
        if($req->lop_hoc_id != "")
        {
            LopHoc::where('id', $req->lop_hoc_id)->delete();

            return redirect()->route('gv-trang-chu')->with('success','Đã lưu vào lớp học lưu trữ');
        }
        return redirect()->route('gv-trang-chu')->with('error','Lữu trữ thất bại');
    }

    public function dsLopHocLuuTru()
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;
        
        $dsLopLuuTru = LopHoc::onlyTrashed()->get();

        return view('./teacher/storage-class',compact('dsLop','dsLopLuuTru'));
    }

    public function phongCho(Request $req)
    {   
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        return view('./teacher/waitting-room',compact('dsLop'));
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
        if($req->nguoi_dung_id != null)
        {
            $ngDung = NguoiDung::find($req->nguoi_dung_id);

            $ngDung->dia_chi = $req->address;

            $ng = NguoiDung::where('email','=',$req->email)->first();

            if($ng != null)
            {
                return redirect()->route('gv-xl-cap-nhat-thong-tin',['nguoi_dung_id' => $req->nguoi_dung_id] )->with('error','Email đã được sử dụng');   
            }
            else
            {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('gv-trang-chu')->with('success','Cập nhật thông tin cá nhân thành công');
        }
        return redirect()->route('gv-trang-chu')->with('error','Xác thực người dùng thất bại');
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
                return redirect()->route('dang-nhap')->with('success','Đổi mật khâu thành công. Hãy đăng nhập lại');
            } else
            {
                return redirect()->route('gv-xl-doi-mat-khau')->with('error','Xác nhận mật khẩu mới không đÚng');
            }
        } else
        {
            return redirect()->route('gv-xl-doi-mat-khau')->with('error','Mật khẩu cũ không đúng');
        }
        return redirect()->route('gv-trang-chu')->with('error','Xác thực người dùng thất bại');
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
