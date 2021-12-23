<?php

namespace App\Http\Controllers;

use App\Models\ChiTietLopHoc;
use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;


class ThemLopMoiController extends Controller
{
    public function DangNhap(Request $request)
    {
        $lop = NguoiDung::where([['ten_dang_nhap', '=', $request->ten_dang_nhap], ['mat_khau', '=', $request->password]])->first();
        if ($lop == null) {
            return 'tôi là ai';
        }
        return view('./layouts/student/index');
    }
    public function thamGiaLop()
    {
        return view('./layouts/student/addclass');
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
}
