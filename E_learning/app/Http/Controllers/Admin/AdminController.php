<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\LopHoc;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
        $ngdung = new NguoiDung();
        $ngdung->ten_dang_nhap = $rq->ten_dang_nhap;
        $ngdung->password = Hash::make($rq->password);
        $ngdung->ho_ten = $rq->ho_ten;
        $ngdung->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $ngdung->gioi_tinh = $rq->gioi_tinh;
        }
        $ngdung->dia_chi = $rq->dia_chi;
        $ngdung->sdt = $rq->sdt;
        $ngdung->email = $rq->email;
        $ngdung->loai_nguoi_dung_id = 2;
        $ngdung->save();
        return redirect()->route('ad-ds-giang-vien');
    }
    public function formCapNhatGV($id)
    {
        $dsGV = NguoiDung::find($id);
        if ($dsGV == null) {
            return "Không có giảng viên có ID = {$id} này ";
        }
        return view('./admin/teacher/edit', compact($dsGV));
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
        $ngdung = new NguoiDung();
        $ngdung->ten_dang_nhap = $rq->ten_dang_nhap;
        $ngdung->password = Hash::make($rq->password);
        $ngdung->ho_ten = $rq->ho_ten;
        $ngdung->ngay_sinh = $rq->ngay_sinh;
        if ($rq->gioi_tinh == "Nam" || $rq->gioi_tinh == "Nữ") {
            $ngdung->gioi_tinh = $rq->gioi_tinh;
        }
        $ngdung->dia_chi = $rq->dia_chi;
        $ngdung->sdt = $rq->sdt;
        $ngdung->email = $rq->email;
        $ngdung->loai_nguoi_dung_id = 1;
        $ngdung->save();
        return redirect()->route('ad-ds-sinh-vien');
    }

    public function formCapNhatSV($id)
    {
        $dsSV = NguoiDung::find($id);
        if ($dsSV == null) {
            return "Không có sinh viên có ID = {$id} này ";
        }
        return view('./admin/student/edit', compact($dsSV));
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
    public function formThemMoiLH()
    {
        return view('./admin/class/create');
    }
    public function xlThemMoiLH(Request $rq)
    {
        $lop = new LopHoc();
        $lop->ma_lop = $rq->ma_lop;
        $lop->ten_lop = $rq->ten_lop;
        $lop->mo_ta = $rq->mo_ta;
        $lop->anh_nen_id = 1;
        $lop->save();
        return redirect()->route('ad-ds-lop');
    }

    public function formCapNhatLH($id)
    {
        $dsLH = LopHoc::find($id);
        if ($dsLH == null) {
            return "Không có lớp có ID = {$id} này ";
        }
        return view('./admin/class/edit', compact($dsLH));
    }


    public function xlXoaLH($id)
    {
        $dsLH = LopHoc::find($id);
        if ($dsLH == null) {
            return "không tìm thấy lớp có ID = {$id} ";
        }
        $dsLH->delete();
        return redirect()->route('ad-ds-lop');
    }
}
