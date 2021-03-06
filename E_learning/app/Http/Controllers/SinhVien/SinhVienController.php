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
use App\Models\BaiNop;
use App\Models\DinhKemBaiNop;
use App\Models\DinhKemBinhLuan;
use DateTime;

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
                return redirect()->route('sv-xl-cap-nhat-thong-tin', ['nguoi_dung_id' => $req->nguoi_dung_id])->with('error', 'Email ???? ???????c s??? d???ng');
            } else {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('sv-trang-chu')->with('success', 'C???p nh???t th??ng tin c?? nh??n th??nh c??ng');
        }
        return redirect()->route('sv-trang-chu')->with('error', 'X??c th???c ng?????i d??ng th???t b???i');
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
                return redirect()->route('dang-nhap')->with('success', '?????i m???t kh??u th??nh c??ng. H??y ????ng nh???p l???i');
            } else {
                return redirect()->route('sv-xl-doi-mat-khau')->with('error', 'X??c nh???n m???t kh???u m???i kh??ng ????ng');
            }
        } else {
            return redirect()->route('sv-xl-doi-mat-khau')->with('error', 'M???t kh???u c?? kh??ng ????ng');
        }
        return redirect()->route('sv-trang-chu')->with('error', 'X??c th???c ng?????i d??ng th???t b???i');
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
            return redirect()->route('sv-trang-chu')->with('error', 'Kh??ng t??m th???y l???p h???c n??y');
        } else {
            $user = ChiTietLopHoc::where('lop_hoc_id', '=', $lop->id)
                ->where('nguoi_dung_id', '=', Auth::id())->first();

            if ($user != null) {
                if ($user->trang_thai == 0)
                    return redirect()->route('sv-trang-chu')->with('error', 'B???n ???? xin tham gia l???p n??y r???i. H??y ch??? gi???ng vi??n cho ph??p b???n v??o l???p.');
                else
                    return redirect()->route('sv-trang-chu')->with('error', 'B???n ???? tham gia l???p h???c n??y r???i.');
            } else {
                $ctLopHoc = new ChiTietLopHoc();
                $ctLopHoc->lop_hoc_id = $lop->id;
                $ctLopHoc->nguoi_dung_id = Auth::id();
                $ctLopHoc->trang_thai = false;  // false trang th??i ch???, true ???? tham gia
                $ctLopHoc->cach_tham_gia = false; //Tham gia b???ng code = false, true: tham gia b???ng mail
                $ctLopHoc->save();

                return redirect()->route('sv-trang-chu')->with('success', 'H??y ch??? Gi???ng vi??n cho ph??p b???n tham gia l???p');
            }
        }
    }

    public function xemChiTietBaiDang(Request $req, $bai_dang_id, $loai_bai_dang_id)
    {
        if ($bai_dang_id != null) {
            if ($loai_bai_dang_id == 2) {
                //L???y dsLop ???? tham gia
                $nguoi_dung_id = Auth::id();
                $dsLopDaVao = [];

                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

                foreach ($dsLop as $lop) {
                    if ($lop->pivot->trang_thai == 1)
                        array_push($dsLopDaVao, $lop);
                }

                //L???y th??ng tin l???p h???c hi???n t???i
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                //L???y b??i ????ng
                $baiDang = BaiDang::find($bai_dang_id);

                $daNop = BaiNop::where([['nguoi_dung_id', '=', $nguoi_dung_id],['bai_dang_id','=',$bai_dang_id]])->count();

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./student/details-homework', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id','daNop'));
            }
            if ($loai_bai_dang_id == 1 || $loai_bai_dang_id == 3) {
                //L???y dsLop ???? tham gia
                $nguoi_dung_id = Auth::id();                
                $dsLopDaVao = [];

                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

                foreach ($dsLop as $lop) {
                    if ($lop->pivot->trang_thai == 1)
                        array_push($dsLopDaVao, $lop);
                }

                //L???y th??ng tin l???p h???c hi???n t???i
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                $baiDang = BaiDang::find($bai_dang_id);

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./student/details-document', compact('lopHoc', 'dsLopDaVao', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
        } else
            return redirect()->back()->with('error', 'Kh??ng t??m th???y b??i ????ng n??y.');
    }

    public function roiLop(Request $req)
    {
        if ($req->lop_hoc_id != null) {
            ChiTietLopHoc::where('lop_hoc_id', '=', $req->lop_hoc_id)
                ->where('nguoi_dung_id', '=', Auth::id())->delete();
            return redirect()->route('sv-trang-chu')->with('success', '???? r???i kh???i l???p h???c.');
        } else
            return redirect()->back()->with('error', 'Thao t??c th???t b???i');
    }

    // public function binhLuan(Request $req, $bai_dang_id, $lop_hoc_id)
    // {

    //     if ($req->user_comment != null || $req->user_comment != '') {
    //         $binhLuan  = new BinhLuan();

    //         $binhLuan->bai_dang_id = $bai_dang_id;
    //         $binhLuan->lop_hoc_id = $lop_hoc_id;
    //         $binhLuan->nguoi_dung_id = Auth::id();
    //         $binhLuan->noi_dung = $req->user_comment;

    //         $binhLuan->save();

    //         return redirect()->back()->with('success', 'Nh???n x??t th??nh c??ng.');
    //     } else
    //         return redirect()->back()->with('error', 'Nh???n x??t th???t b???i.');
    // }

    public function dangXuat()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dang-nhap');
    }

    public function vietBinhLuan(Request $req, $bai_dang_id)
    {
        if (trim($req->user_comment) != '') {
            $idNgDung = Auth::id();
            $binhluan = new BinhLuan();

            $binhluan->bai_dang_id = $bai_dang_id;
            $binhluan->nguoi_dung_id = $idNgDung;
            $binhluan->noi_dung = $req->user_comment;
            $binhluan->save();
            if ($req->dinh_kem_cmt != null) {
                $dkemBinhLuan = new DinhKemBinhLuan();

                $dkemBinhLuan->binh_luan_id = $binhluan->id;
                //dd($req->dinh_kem_cmt);
                $dkemBinhLuan->dinh_kem = $req->dinh_kem_cmt->getClientOriginalName();

                //L??u tr??? file
                $req->dinh_kem_cmt->storeAs('dinhkem/commet_file/', $req->dinh_kem_cmt->getClientOriginalName());

                $dkemBinhLuan->save();
            }
            return redirect()->back();
        } else {
            $idNgDung = Auth::id();
            $binhluan = new BinhLuan();

            $binhluan->bai_dang_id = $bai_dang_id;
            $binhluan->nguoi_dung_id = $idNgDung;
            $binhluan->noi_dung = '';
            $binhluan->save();
            if ($req->dinh_kem_cmt != null) {
                $dkemBinhLuan = new DinhKemBinhLuan();

                $dkemBinhLuan->binh_luan_id = $binhluan->id;


                $dkemBinhLuan->dinh_kem = $req->dinh_kem_cmt->getClientOriginalName();

                //L??u tr??? file
                $req->dinh_kem_cmt->storeAs('dinhkem/commet_file/', $req->dinh_kem_cmt->getClientOriginalName());

                $dkemBinhLuan->save();
            }
            return redirect()->back();
        }
    }

    public function baiNop(Request $req, $bai_dang_id)
    {
        if ($req->dinh_kem != null) {
            $idNgDung = Auth::id();
            $daNop = BaiNop::where('nguoi_dung_id', '=', $idNgDung)->count();

            if ($daNop > 0) {
                $baiNop = BaiNop::where('nguoi_dung_id', '=', $idNgDung)->first();
                $dkemBaiNop = DinhKemBaiNop::where('bai_nop_id', '=', $baiNop->id)->first();

                $dkemBaiNop->bai_nop_id = $baiNop->id;
                $dkemBaiNop->dinh_kem = $req->dinh_kem->getClientOriginalName();
                $dkemBaiNop->save();

                $req->dinh_kem->storeAs('dinhkem', $req->dinh_kem->getClientOriginalName());
                return redirect()->back()->with('success', 'N???p l???i th??nh c??ng');
            } else {
                $baiNop = new BaiNop();
                $baiNop->bai_dang_id = $bai_dang_id;
                $baiNop->nguoi_dung_id = $idNgDung;
                $baiNop->save();

                $dkemBaiNop = new DinhKemBaiNop();

                $dkemBaiNop->bai_nop_id = $baiNop->id;
                $dkemBaiNop->dinh_kem = $req->dinh_kem->getClientOriginalName();

                $req->dinh_kem->storeAs('dinhkem/homework/', $req->dinh_kem->getClientOriginalName());
                $dkemBaiNop->save();
            }
            return redirect()->back()->with('success', 'N???p th??nh c??ng');
        } else {
            return redirect()->back()->with('fail', 'Kh??ng c?? ????nh k??m');
        }
    }
}
