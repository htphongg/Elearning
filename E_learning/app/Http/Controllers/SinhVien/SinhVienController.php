<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\ChiTietLopHoc;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
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
