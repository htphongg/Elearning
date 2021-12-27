<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\ChiTietLopHoc;
use App\Models\LopHoc;
use App\Models\PhongChoLopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class SinhVienController extends Controller
{
    public function layDsLop()
    {
        if (Auth::check()) {
            $nguoi_dung_id = Auth::id();
            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            return view('./student/index', compact('dsLop'));
        }
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
        
        if($req->nguoi_dung_id != null)
        {
            $ngDung = NguoiDung::find($req->nguoi_dung_id);

            $ngDung->dia_chi = $req->address;

            $ng = NguoiDung::where('email','=',$req->email)->first();

            if($ng != null)
            {
                return redirect()->route('sv-xl-cap-nhat-thong-tin',['nguoi_dung_id' => $req->nguoi_dung_id] )->with('error','Email đã được sử dụng');   
            }
            else
            {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('sv-trang-chu')->with('success','Cập nhật thông tin cá nhân thành công');
        }
        return redirect()->route('sv-trang-chu')->with('error','Xác thực người dùng thất bại');
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
                return redirect()->route('dang-nhap')->with('success','Đổi mật khâu thành công. Hãy đăng nhập lại');
            } else
            {
                return redirect()->route('sv-xl-doi-mat-khau')->with('error','Xác nhận mật khẩu mới không đÚng');
            }
        } else
        {
            return redirect()->route('sv-xl-doi-mat-khau')->with('error','Mật khẩu cũ không đúng');
        }
        return redirect()->route('sv-trang-chu')->with('error','Xác thực người dùng thất bại');
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
        if($lop == null)
        {
            return redirect()->route('sv-trang-chu')->with('error','Không tìm thấy lớp học này');
        }
        else
        {
            $user = ChiTietLopHoc::where('lop_hoc_id','=',$lop->id)
                                ->where('nguoi_dung_id','=',Auth::id())->first();

            if($user != null)
            {
                return redirect()->route('sv-trang-chu')->with('error','Bạn đã tham gia lớp học này rồi.');
            }
            else
            {
                $phongCho = new PhongChoLopHoc();
                $phongCho->lop_hoc_id = $lop->id;
                $phongCho->nguoi_dung_id = Auth::id();
                $phongCho->save();
                
                return redirect()->route('sv-trang-chu')->with('success','Hãy chờ Giảng viên cho phép bạn tham gia lớp');
            }
        }
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
}
