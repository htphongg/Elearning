<?php

namespace App\Http\Controllers;

use App\Models\ChiTietLopHoc;
use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\NguoiDung;

class ThemLopMoiController extends Controller
{
    public function ThemLop()
    {
        return view('./layouts/student/addclass');
    }
    public function xlThemMoi(Request $request)
    {
        $lop = LopHoc::where('ma_lop', '=', $request->codeclass)->first();

        // $chiTietLop = new ChiTietLopHoc();
        // $chiTietLop->lop_hoc_id = $lop->id;
        // $chiTietLop->nguoi_dung_id =  //id nguoi dung đang đăng nhập
        // $chiTietLop->save();
    }
}
