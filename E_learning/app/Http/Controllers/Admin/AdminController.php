<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\LopHoc;
use App\Models\BaiDang;
use App\Models\LoaiBaiDang;
use App\Models\DinhKemBaiDang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function LayThongtin()
    // {
    //     $thongtinAdmin = NguoiDung::all()->where('loai_nguoi_dung_id', '0');
    //     return view('./admin/index', compact('thongtinAdmin'));
    // }

    public function formCapNhatThongTinCaNhan()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./admin/update-infor', ['ngDung' => $ngDung]);
        }
    }

    public function xuLyCapNhatThongTinCaNhan(Request $req)
    {
        if ($req->nguoi_dung_id != null) {
            $ngDung = NguoiDung::find($req->nguoi_dung_id);

            $ngDung->dia_chi = $req->address;

            $ng = NguoiDung::where('email', '=', $req->email)->first();

            if ($ng != null) {
                return redirect()->route('ad-xl-cap-nhat-thong-tin', ['nguoi_dung_id' => $req->nguoi_dung_id])->with('error', 'Email đã được sử dụng');
            } else {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('ad-trang-chu')->with('success', 'Cập nhật thông tin cá nhân thành công');
        }
        return redirect()->route('ad-trang-chu')->with('error', 'Xác thực người dùng thất bại');
    }

    public function formDoiMatKhau()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $ngDung = NguoiDung::find($id);
            return view('./admin/change-password', ['ngDung' => $ngDung]);
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
                return redirect()->route('ad-xl-doi-mat-khau')->with('error', 'Xác nhận mật khẩu mới không đÚng');
            }
        } else {
            return redirect()->route('ad-xl-doi-mat-khau')->with('error', 'Mật khẩu cũ không đúng');
        }
        return redirect()->route('ad-trang-chu')->with('error', 'Xác thực người dùng thất bại');
    }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }
    //LONG
    //Giảng Viên
    public function LayDSGV()
    {
        $dsGV = NguoiDung::all()->where('loai_nguoi_dung_id', '2');
        return view('./admin/teacher/index', compact('dsGV'));
    }
    public function formThemMoiGV()
    {
        return view('./admin/teacher/create');
    }
    public function xlThemMoiGV(Request $rq)
    {
        $GV = new NguoiDung();
        $GV->ten_dang_nhap = $rq->ten_dang_nhap;
        $GV->password = Hash::make($rq->password);
        $GV->ho_ten = $rq->ho_ten;
        $GV->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $GV->gioi_tinh = $rq->gioi_tinh;
        }
        $GV->dia_chi = $rq->dia_chi;
        $GV->sdt = $rq->sdt;
        $GV->email = $rq->email;
        $GV->token = Str::random(10);
        $GV->loai_nguoi_dung_id = 2;
        $GV->save();
        return redirect()->route('ad-ds-giang-vien');
    }
    public function formCapNhatGV($id)
    {
        $dsGV = NguoiDung::find($id);
        if ($dsGV == null) {
            return "Không có giảng viên có ID = {$id} này ";
        }
        return view('../admin/teacher/edit', ['dsGV'  => $dsGV]);
    }
    public function xlCapnhatGV(Request $rq, $id)
    {
        $GV = NguoiDung::find($id);
        if ($GV == null) {
            return "không tìm thấy giảng viên có ID = {$id} ";
        }
        $GV->ho_ten = $rq->ho_ten;
        $GV->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $GV->gioi_tinh = $rq->gioi_tinh;
        }
        $GV->dia_chi = $rq->dia_chi;
        $GV->sdt = $rq->sdt;
        $GV->email = $rq->email;
        $GV->save();
        return redirect()->route('ad-ds-giang-vien');
    }
    public function xlXoaGV($id)
    {
        $dsGV = NguoiDung::find($id);
        if ($dsGV == null) {
            return "không tìm thấy giảng viên có ID = {$id} ";
        }
        $dsGV->delete();
        return redirect()->route('ad-ds-giang-vien');
    }

    //Sinh Viên
    public function LayDSSV()
    {
        $dsSV = NguoiDung::all()->where('loai_nguoi_dung_id', '1');
        return view('./admin/student/index', compact('dsSV'));
    }
    public function formThemMoiSV()
    {
        return view('./admin/student/create');
    }
    public function xlThemMoiSV(Request $rq)
    {
        $SV = new NguoiDung();
        $SV->ten_dang_nhap = $rq->ten_dang_nhap;
        $SV->password = Hash::make($rq->password);
        $SV->ho_ten = $rq->ho_ten;
        $SV->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $SV->gioi_tinh = $rq->gioi_tinh;
        }
        $SV->dia_chi = $rq->dia_chi;
        $SV->sdt = $rq->sdt;
        $SV->email = $rq->email;
        $SV->loai_nguoi_dung_id = 1;
        $SV->save();
        return redirect()->route('ad-ds-sinh-vien');
    }

    public function formCapNhatSV($id)
    {
        $dsSV = NguoiDung::find($id);
        if ($dsSV == null) {
            return "Không có sinh viên có ID = {$id} này ";
        }
        return view('./admin/student/edit', ['dsSV'  => $dsSV]);
    }
    public function xlCapnhatSV(Request $rq, $id)
    {
        $SV = NguoiDung::find($id);
        if ($SV == null) {
            return "không tìm thấy giảng viên có ID = {$id} ";
        }
        $SV->ho_ten = $rq->ho_ten;
        $SV->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $SV->gioi_tinh = $rq->gioi_tinh;
        }
        $SV->dia_chi = $rq->dia_chi;
        $SV->sdt = $rq->sdt;
        $SV->email = $rq->email;
        $SV->save();
        return redirect()->route('ad-ds-sinh-vien');
    }

    public function xlXoaSV($id)
    {
        $dsSV = NguoiDung::find($id);
        if ($dsSV == null) {
            return "không tìm thấy sinh viên có ID = {$id} ";
        }
        $dsSV->delete();
        return redirect()->route('ad-ds-sinh-vien');
    }
    //Lớp
    public function LayDSLop()
    {
        $dsLH = LopHoc::all();
        return view('./admin/class/index', compact('dsLH'));
    }
    // public function formThemMoiLH()
    // {
    //     return view('./admin/class/create');
    // }
    // public function xlThemMoiLH(Request $rq)
    // {
    //     $lop = new LopHoc();
    //     $lop->ma_lop = $rq->ma_lop;
    //     $lop->ten_lop = $rq->ten_lop;
    //     $lop->mo_ta = $rq->mo_ta;
    //     $lop->anh_nen_id = 1;
    //     $lop->save();
    //     return redirect()->route('ad-ds-lop');
    // }

    public function formCapNhatLH($id)
    {
        $dsLH = LopHoc::find($id);
        if ($dsLH == null) {
            return "Không có lớp có ID = {$id} này ";
        }
        return view('./admin/class/edit', compact('dsLH'));
    }

    // public function xlCapnhatLH(Request $rq, $id)
    // {
    //     $LH = LopHoc::find($id);
    //     if ($LH == null) {
    //         return "không tìm thấy lớp học có ID = {$id} ";
    //     }
    //     $LH->ten_lop = $rq->ten_lop;
    //     $LH->mo_ta = $rq->mo_ta;
    //     $LH->save();
    //     return redirect()->route('ad-ds-lop');
    // }

    public function xlXoaLH($id)
    {
        $dsLH = LopHoc::find($id);
        if ($dsLH == null) {
            return "không tìm thấy lớp có ID = {$id} ";
        }
        $dsLH->delete();
        return redirect()->route('ad-ds-lop');
    }

    public function XemChiTietLop($id)
    {
        $chitietlop = LopHoc::find($id);
        if ($chitietlop == null) {
            return "Không có bài đăng có ID = {$id} này ";
        }
        return view('./admin/class/detail', compact('chitietlop'));
    }

    public function LayDSBaiDang()
    {
        $index_baidang = 0;
        $index_lophoc = 0;
        $ds_loai = LoaiBaiDang::all();
        $ds_baidang_cuaLop = LopHoc::all();
        $ds_baidang = BaiDang::all();
        return view('./admin/post/index', compact('ds_baidang', 'ds_baidang_cuaLop', 'ds_loai'), ['index_baidang' => $index_baidang, 'index_lophoc' => $index_lophoc]);
    }
    public function LocDuLieu(Request $rq)
    {
        $ds_loai = LoaiBaiDang::all();
        $ds_baidang_cuaLop = LopHoc::all();
        $ds_baidang = BaiDang::all();
        $index_baidang = $rq->loai_bai_dang;
        $index_lophoc = $rq->lop_hoc;
        if ($rq->loai_bai_dang == "0" && $rq->lop_hoc == "0") {
            return view('./admin/post/index', compact('ds_baidang', 'ds_baidang_cuaLop', 'ds_loai'), ['index_baidang' => $index_baidang, 'index_lophoc' => $index_lophoc]);
        } else {

            $loai = LoaiBaiDang::find($rq->loai_bai_dang);
            $baidang_cuaLop = LopHoc::find($rq->lop_hoc);
            //lọc theo lớp nếu người dùng chọn bài đăng là tất cả
            if ($rq->loai_bai_dang == "0") {
                //dd('kkkkk');
                $ds_baidang = BaiDang::where('lop_hoc_id', $baidang_cuaLop->id)->get();
                return view('./admin/post/index', compact('ds_baidang', 'ds_baidang_cuaLop', 'ds_loai'), ['index_baidang' => $index_baidang, 'index_lophoc' => $index_lophoc]);
            }

            //lọc theo bài đăng nếu người dùng chọn lớp là tất cả
            if ($rq->lop_hoc == "0") {
                $ds_baidang = BaiDang::where('loai_bai_dang_id',  $loai->id)->get();
                return view('./admin/post/index', compact('ds_baidang', 'ds_baidang_cuaLop', 'ds_loai'), ['index_baidang' => $index_baidang, 'index_lophoc' => $index_lophoc]);
            }

            $ds_baidang = BaiDang::where([['loai_bai_dang_id',  $loai->id], ['lop_hoc_id', $baidang_cuaLop->id]])->get();
            return view('./admin/post/index', compact('ds_baidang', 'ds_baidang_cuaLop', 'ds_loai'), ['index_baidang' => $index_baidang, 'index_lophoc' => $index_lophoc]);
        }
    }
    public function XemChiTietBaiDang($id)
    {

        $chitietbaidang = BaiDang::find($id);

        $dinhkem = DinhKemBaiDang::all();
        if ($chitietbaidang == null) {
            return "Không có bài đăng có ID = {$id} này ";
        }
        return view('./admin/post/detail', compact('chitietbaidang',));
    }
    public function xlXoaBaiDang($id)
    {
        $baidang = BaiDang::find($id);
        if ($baidang == null) {
            return "không tìm thấy bài đăng có ID = {$id} ";
        }
        $baidang->delete();
        return redirect()->route('ad-ds-bai-dang');
    }
}
