<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\ChiTietLopHoc;
use App\Models\LopHoc;
use App\Models\BaiDang;
use App\Models\PhongChoLopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\BinhLuan;

class SinhVienController extends Controller
{
    public function layDsLop()
    {
        if (Auth::check()) {

            $nguoi_dung_id = Auth::id();

            $dsLopDaVao = [];

            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            foreach ($dsLop as $lop) {
                if ($lop->pivot->trang_thai == 1)
                    array_push($dsLopDaVao, $lop);
            }

            return view('./student/index', compact('dsLopDaVao'));
        }
    }

    public function formQuenMatKhau()
    {
        if (Auth::check()) {

            $nguoi_dung_id = Auth::id();

            $dsLopDaVao = [];

            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            foreach ($dsLop as $lop) {
                if ($lop->pivot->trang_thai == 1)
                    array_push($dsLopDaVao, $lop);
            }

            return view('./student/index', compact('dsLopDaVao'));
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

        if ($req->nguoi_dung_id != null) {
            $ngDung = NguoiDung::find($req->nguoi_dung_id);

            $ngDung->dia_chi = $req->address;

            $ng = NguoiDung::where('email', '=', $req->email)->first();

            if ($ng != null) {
                return redirect()->route('sv-xl-cap-nhat-thong-tin', ['nguoi_dung_id' => $req->nguoi_dung_id])->with('error', 'Email đã được sử dụng');
            } else {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('sv-trang-chu')->with('success', 'Cập nhật thông tin cá nhân thành công');
        }
        return redirect()->route('sv-trang-chu')->with('error', 'Xác thực người dùng thất bại');
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
                return redirect()->route('dang-nhap')->with('success', 'Đổi mật khâu thành công. Hãy đăng nhập lại');
            } else {
                return redirect()->route('sv-xl-doi-mat-khau')->with('error', 'Xác nhận mật khẩu mới không đÚng');
            }
        } else {
            return redirect()->route('sv-xl-doi-mat-khau')->with('error', 'Mật khẩu cũ không đúng');
        }
        return redirect()->route('sv-trang-chu')->with('error', 'Xác thực người dùng thất bại');
    }

    public function showChiTietLop(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLopDaVao = [];

        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        foreach ($dsLop as $lop) {
            if ($lop->pivot->trang_thai == 1)
                array_push($dsLopDaVao, $lop);
        }

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/class', compact('lopHoc', 'dsLopDaVao'));
    }

    public function showCongViec(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLopDaVao = [];

        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        foreach ($dsLop as $lop) {
            if ($lop->pivot->trang_thai == 1)
                array_push($dsLopDaVao, $lop);
        }


        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/work', compact('lopHoc', 'dsLopDaVao'));
    }

    public function showTatCaThanhVien(Request $req)
    {
        $nguoi_dung_id = Auth::id();
        $dsLopDaVao = [];

        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        foreach ($dsLop as $lop) {
            if ($lop->pivot->trang_thai == 1)
                array_push($dsLopDaVao, $lop);
        }

        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./student/everybody', compact('lopHoc', 'dsLopDaVao'));
    }

    public function thamGiaLop()
    {
        return view('./student/addclass');
    }
    public function xlthamGiaLop(Request $request)
    {
        $lop = LopHoc::where('ma_lop', '=', $request->codeclass)->first();
        if ($lop == null) {
            return redirect()->route('sv-trang-chu')->with('error', 'Không tìm thấy lớp học này');
        } else {
            $user = ChiTietLopHoc::where('lop_hoc_id', '=', $lop->id)
                ->where('nguoi_dung_id', '=', Auth::id())->first();

            if ($user != null) {
                return redirect()->route('sv-trang-chu')->with('error', 'Bạn đã tham gia lớp học này rồi.');
            } else {
                $ctLopHoc = new ChiTietLopHoc();
                $ctLopHoc->lop_hoc_id = $lop->id;
                $ctLopHoc->nguoi_dung_id = Auth::id();
                $ctLopHoc->trang_thai = false;  // false trang thái chờ, true đã tham gia
                $ctLopHoc->cach_tham_gia = false; //Tham gia bằng code = false, true: tham gia bằng mail
                $ctLopHoc->save();

                return redirect()->route('sv-trang-chu')->with('success', 'Hãy chờ Giảng viên cho phép bạn tham gia lớp');
            }
        }
    }

    public function xemChiTietBaiDang(Request $req, $bai_dang_id, $loai_bai_dang_id)
    {
        if ($bai_dang_id != null) {
            if ($loai_bai_dang_id == 2) {
                //Lấy dsLop đã tham gia
                $nguoi_dung_id = Auth::id();
                $dsLopDaVao = [];

                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

                foreach ($dsLop as $lop) {
                    if ($lop->pivot->trang_thai == 1)
                        array_push($dsLopDaVao, $lop);
                }

                //Lấy thông tin lớp học hiện tại
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                //Lấy bài đăng
                $baiDang = BaiDang::find($bai_dang_id);

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./student/details-homework', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
            if ($loai_bai_dang_id == 1 || $loai_bai_dang_id == 3) {
                //Lấy dsLop đã tham gia
                $nguoi_dung_id = Auth::id();
                $dsLopDaVao = [];

                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

                foreach ($dsLop as $lop) {
                    if ($lop->pivot->trang_thai == 1)
                        array_push($dsLopDaVao, $lop);
                }

                //Lấy thông tin lớp học hiện tại
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                $baiDang = BaiDang::find($bai_dang_id);

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./student/details-document', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
        } else
            return redirect()->back()->with('error', 'Không tìm thấy bài đăng này.');
    }

    public function roiLop(Request $req)
    {
        if ($req->lop_hoc_id != null) {
            ChiTietLopHoc::where('lop_hoc_id', '=', $req->lop_hoc_id)
                ->where('nguoi_dung_id', '=', Auth::id())->delete();
            return redirect()->route('sv-trang-chu')->with('success', 'Đã rời khỏi lớp học.');
        } else
            return redirect()->back()->with('error', 'Thao tác thất bại');
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }

    public function vietBinhLuan(Request $req, $bai_dang_id, $loai_bai_dang_id, $lop_hoc_id)
    {
        if (trim($req->user_comment) != '') {
            $idNgDung = Auth::id();
            $binhluan = new BinhLuan();

            $binhluan->bai_dang_id = $bai_dang_id;
            $binhluan->nguoi_dung_id = $idNgDung;
            $binhluan->noi_dung = $req->user_comment;
            $binhluan->save();

            $nguoi_dung_id = Auth::id();
            $dsLopDaVao = [];

            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            foreach ($dsLop as $lop) {
                if ($lop->pivot->trang_thai == 1)
                    array_push($dsLopDaVao, $lop);
            }

            //Lấy thông tin lớp học hiện tại
            $lopHoc = LopHoc::find($lop_hoc_id);

            //Lấy bài đăng
            $baiDang = BaiDang::find($bai_dang_id);

            $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

            if ($loai_bai_dang_id == 1 || $loai_bai_dang_id == 3) {
                return redirect()->back();
                //return view('./student/details-document', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }

            if ($loai_bai_dang_id == 2) {
                return redirect()->back();
                //return view('./student/details-homework', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
        }
    }
}
