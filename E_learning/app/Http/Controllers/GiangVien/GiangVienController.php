<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\lopHoc;
use App\Models\BaiDang;
use App\Models\BinhLuan;
use App\Models\DinhKemBaiDang;
use App\Models\PhongChoLopHoc;
use App\Models\ChiTietLopHoc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CapNhatThongTinCaNhanRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;

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
        if ($req->ten_lop != "" || $req->mo_ta != "") {
            if (LopHoc::where('ten_lop', '=', $req->ten_lop)->first()) {
                return redirect()->route('gv-tao-lop')->with('error', 'Tên lớp đã được sử dụng');
            } else {
                $lopHoc = new LopHoc();

                $lopHoc->ma_lop = Str::random(6);
                $lopHoc->ten_lop = $req->ten_lop;
                $lopHoc->mo_ta = $req->mo_ta;
                $lopHoc->anh_nen_id = 1;
                $lopHoc->save();

                $ctLopHoc = new ChiTietLopHoc();
                $ctLopHoc->lop_hoc_id = $lopHoc->id;
                $ctLopHoc->nguoi_dung_id = Auth::id();
                $ctLopHoc->trang_thai = true;
                $ctLopHoc->cach_tham_gia = false;
                $ctLopHoc->save();

                return redirect()->route('gv-trang-chu')->with('success', 'Tạo lớp thành công.');
            }
        } else
            return redirect()->route('gv-tao-lop')->with('error', 'Tên lớp không được trống.');
    }

    public function chinhSuaLop(Request $req)
    {
        $lopHoc = LopHoc::find($req->lop_hoc_id);
        return view('./teacher/edit-class', compact('lopHoc'));
    }

    public function xlChinhSuaLop(Request $req)
    {
        if ($req->lop_hoc_id != "" || $req->mo_ta != "") {
            $lopHoc = LopHoc::find($req->lop_hoc_id);

            $lopHoc->mo_ta = $req->mo_ta;

            $lopHoc->save();

            return redirect()->route('gv-trang-chu')->with('success', 'Chỉnh sửa thành công');
        }
        return redirect()->route('gv-xl-chinh-sua-lop', ['lop_hoc_id' =>  $req->lop_hoc_id])->with('error', 'Chỉnh sửa thất bại');
    }

    public function xoaLopHoc(Request $req)
    {
        if ($req->lop_hoc_id != "") {
            LopHoc::where('id', $req->lop_hoc_id)->delete();

            ChiTietLopHoc::where('lop_hoc_id', '=', $req->lop_hoc_id)->delete();

            return redirect()->route('gv-trang-chu')->with('success', 'Đã lưu vào lớp học lưu trữ');
        }
        return redirect()->route('gv-trang-chu')->with('error', 'Lữu trữ thất bại');
    }

    public function dsLopHocLuuTru()
    {
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $dsLopLuuTru = LopHoc::onlyTrashed()->get();

        return view('./teacher/storage-class', compact('dsLop', 'dsLopLuuTru'));
    }

    public function phongCho(Request $req)
    {
        //Lấy ds lớP đã tham gia của ng dùng đang đăng nhập
        $nguoi_dung_id = Auth::id();
        $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

        $lopHoc = LopHoc::find($req->lop_hoc_id);

        return view('./teacher/waitting-room', compact('dsLop', 'lopHoc'));
    }

    public function xlPhongCho($lop_id, $ngd_id, $tacvu)
    {
        if ($lop_id != null && $ngd_id != null && $tacvu != null) {
            $dsNguoiDung = LopHoc::find($lop_id)->dsNguoiDung;

            foreach ($dsNguoiDung as $ngDung) {
                if ($ngDung->pivot->nguoi_dung_id == $ngd_id && $ngDung->pivot->trang_thai == 0 && $tacvu == "t") {
                    $ngDung->pivot->update(['trang_thai' => 1]);
                    return redirect()->back()->with('success', 'Đã duyệt sinh viên này vào lớp.');
                }
                if ($ngDung->pivot->nguoi_dung_id == $ngd_id && $ngDung->pivot->trang_thai == 0 && $tacvu == "x") {
                    $ngDung->pivot->delete();
                    return redirect()->back()->with('success', 'Đã xoá sinh viên này khỏi danh sách chờ.');
                }
            }
        } else
            return redirect()->back()->with('error', 'Không thể thực hiện tác vụ này.');
    }

    public function formDangBai(Request $req,$lop_hoc_id)
    {
        return view('./teacher/create-post',['lop_hoc_id' => $lop_hoc_id]);
    }

    public function xlDangBai( Request $req,$lop_hoc_id)
    {   
        if($req->tieu_de != null && $req->noi_dung != null && $req->loai_bai_dang != null)
        {
            if(strcasecmp($req->loai_bai_dang,'tài liệu') == 0){
                $baidang = new BaiDang();

                $baidang->tieu_de = $req->tieu_de;
                $baidang->noi_dung = $req->noi_dung;
                $baidang->han_nop = $req->deadline;
                $baidang->loai_bai_dang_id = 1;
                $baidang->lop_hoc_id = $req->lop_hoc_id;
                $baidang->save();
                // dd($req->dinh_kem);
                if ($req->dinh_kem != null) {
                    $dkemBaiDang = new DinhKemBaiDang();

                    $dkemBaiDang->bai_dang_id = $baidang->id;
                    $dkemBaiDang->dinh_kem = $req->dinh_kem->getClientOriginalName();

                    //Lưu trữ file
                    $req->dinh_kem->storeAs('dinhkem/post/', $req->dinh_kem->getClientOriginalName());

                    $dkemBaiDang->save();
                }

                return redirect()->route('gv-cong-viec', ['lop_hoc_id' => $req->lop_hoc_id])->with('success', 'Đăng bài thành công');
            }

            if (strcasecmp($req->loai_bai_dang, 'bài tập') == 0) {
                $baidang = new BaiDang();

                $baidang->tieu_de = $req->tieu_de;
                $baidang->noi_dung = $req->noi_dung;
                $baidang->han_nop = $req->deadline;
                $baidang->loai_bai_dang_id = 2;
                $baidang->lop_hoc_id = $req->lop_hoc_id;
                $baidang->save();

                if ($req->dinh_kem != null) {
                    $dkemBaiDang = new DinhKemBaiDang();

                    $dkemBaiDang->bai_dang_id = $baidang->id;
                    $dkemBaiDang->dinh_kem = $req->dinh_kem->getClientOriginalName();

                    //Lưu trữ file
                    $req->dinh_kem->storeAs('dinhkem/post/', $req->dinh_kem->getClientOriginalName());

                    $dkemBaiDang->save();
                }

                return redirect()->route('gv-cong-viec', ['lop_hoc_id' => $req->lop_hoc_id])->with('success', 'Đăng bài thành công');
            }

            if (strcasecmp($req->loai_bai_dang, 'thông báo') == 0) {
                $baidang = new BaiDang();

                $baidang->tieu_de = $req->tieu_de;
                $baidang->noi_dung = $req->noi_dung;
                $baidang->han_nop = $req->deadline;
                $baidang->loai_bai_dang_id = 3;
                $baidang->lop_hoc_id = $req->lop_hoc_id;
                $baidang->save();

                if ($req->dinh_kem != null) {
                    $dkemBaiDang = new DinhKemBaiDang();

                    $dkemBaiDang->bai_dang_id = $baidang->id;
                    $dkemBaiDang->dinh_kem = $req->dinh_kem->getClientOriginalName();

                    //Lưu trữ file
                    $req->dinh_kem->storeAs('dinhkem/post/', $req->dinh_kem->getClientOriginalName());
                   
                    $dkemBaiDang->save();
                }

                return redirect()->route('gv-cong-viec', ['lop_hoc_id' => $req->lop_hoc_id])->with('success', 'Đăng bài thành công');
            }
        } else
            return redirect()->back()->with('error', 'Thao tác thất bại.');
    }

    public function formChinhSuaBaiDang($bai_dang_id)
    {
        if ($bai_dang_id != null) {
            $baiDang = BaiDang::find($bai_dang_id);
            return view('./teacher/edit-post', compact('baiDang'));
        } else
            return redirect()->back()->with('error', 'Không tìm thấy bài đăng này.');
    }

    public function xlChinhSuaBaiDang(Request $req, $bai_dang_id)
    {
        if ($bai_dang_id != null) {
            $baiDang = BaiDang::find($bai_dang_id);
            if ($baiDang != null) {
                $baiDang->tieu_de = $req->tieu_de;
                $baiDang->noi_dung = $req->noi_dung;
                $baiDang->han_nop = $req->deadline;

                //Xử lý cập nhật đÍnh kèm
                if($req->dinh_kem != null)
                {
                    $dinhkembaiDang = DinhKemBaiDang::where('bai_dang_id','=',$bai_dang_id)->first();

                    if($dinhkembaiDang == null)
                    {
                        $dkemBaiDang = new DinhKemBaiDang();
                        $dkemBaiDang->bai_dang_id = $bai_dang_id;
                        $dkemBaiDang->dinh_kem = $req->dinh_kem->getClientOriginalName();
                        $req->dinh_kem->storeAs('dinhkem/post/', $req->dinh_kem->getClientOriginalName());
                        $dkemBaiDang->save();
                    }
                    else
                    {
                        $dinhkembaiDang->update(['dinh_kem' => $req->dinh_kem->getClientOriginalName()]);
                        $req->dinh_kem->storeAs('dinhkem/post/', $req->dinh_kem->getClientOriginalName());
                    }
                }

                $baiDang->save();
                return redirect()->route('gv-cong-viec', ['lop_hoc_id' => $req->lop_hoc_id])->with('success', 'Chỉnh sửa thành công.');
            }
            return redirect()->back()->with('error', 'Không tìm thấy bài đăng này.');
        } else
            return redirect()->back()->with('error', 'Thao tác thất bại.');
    }

    public function xemChiTietBaiDang(Request $req, $bai_dang_id, $loai_bai_dang_id)
    {
        if ($bai_dang_id != null) {
            if ($loai_bai_dang_id == 2) {
                //Lấy dsLop đã tham gia
                $nguoi_dung_id = Auth::id();
                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;
                //Lấy thông tin lớp học hiện tại
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                //Lấy bài đăng
                $baiDang = BaiDang::find($bai_dang_id);

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./teacher/details-homework', compact('lopHoc', 'dsLop', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
            if ($loai_bai_dang_id == 1 || $loai_bai_dang_id == 3) {
                //Lấy dsLop đã tham gia
                $nguoi_dung_id = Auth::id();
                $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;
                //Lấy thông tin lớp học hiện tại
                $lopHoc = LopHoc::find($req->lop_hoc_id);

                $baiDang = BaiDang::find($bai_dang_id);

                $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

                return view('./teacher/details-document', compact('lopHoc', 'dsLop', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
        } else
            return redirect()->back()->with('error', 'Không tìm thấy bài đăng này.');
    }

    public function xoaBaiDang(Request $req)
    {
        if ($req->bai_dang_id != null) {
            BaiDang::find($req->bai_dang_id)->delete();
            DinhKemBaiDang::where('bai_dang_id','=',$req->bai_dang_id)->delete();
            return redirect()->back()->with('success','Xoá thành công.');
        }
        else
            return redirect()->back()->with('error','Xoá không thành công.');
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
        if ($req->nguoi_dung_id != null) {
            $ngDung = NguoiDung::find($req->nguoi_dung_id);

            $ngDung->dia_chi = $req->address;

            $ng = NguoiDung::where('email', '=', $req->email)->first();

            if ($ng != null) {
                return redirect()->route('gv-xl-cap-nhat-thong-tin', ['nguoi_dung_id' => $req->nguoi_dung_id])->with('error', 'Email đã được sử dụng');
            } else {
                $ngDung->email = $req->email;
            }

            $ngDung->save();

            return redirect()->route('gv-trang-chu')->with('success', 'Cập nhật thông tin cá nhân thành công');
        }
        return redirect()->route('gv-trang-chu')->with('error', 'Xác thực người dùng thất bại');
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
                return redirect()->route('dang-nhap')->with('success', 'Đổi mật khâu thành công. Hãy đăng nhập lại');
            } else {
                return redirect()->route('gv-xl-doi-mat-khau')->with('error', 'Xác nhận mật khẩu mới không đÚng');
            }
        } else {
            return redirect()->route('gv-xl-doi-mat-khau')->with('error', 'Mật khẩu cũ không đúng');
        }
        return redirect()->route('gv-trang-chu')->with('error', 'Xác thực người dùng thất bại');
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

    public function formMoiThamGia(Request $req)
    {
        return view('./teacher/invite-student', ['lop_hoc_id' => $req->lop_hoc_id]);
    }

    public function xlMoiThamGia(Request $req)
    {
        if ($req->lop_hoc_id != null && $req->email != null) {
            $user = NguoiDung::where('email', '=', $req->email)->first();
            if ($user != null) {
                $joined = LopHoc::find($req->lop_hoc_id)->dsNguoiDung->where('email', '=', $req->email)->first();
                if ($joined == null) {
                    $name = $user->ho_ten;
                    $email_address = $user->email;

                    $data = [
                        'id' => $user->id,
                        'name' => $user->ho_ten,
                        'lop_hoc_id' => $req->lop_hoc_id,
                    ];

                    Mail::send('./mails/invite-student', compact('data'), function ($email) use ($name, $email_address) {
                        $email->subject('Lời mời tham gia lớp học');
                        $email->to($email_address, $name);
                    });
                    return redirect()->back()->with('success', 'Đã gửi lời mời đến người dùng này.');
                } else
                    return redirect()->back()->with('error', 'Người dùng này đã tham gia lớp học rồi hoặc đang trong phòng chờ.');
            } else
                return redirect()->back()->with('error', 'Email này không tồn tại trong hệ thống');
        } else {
            return redirect()->back()->with('error', 'Thao tác thất bại');
        }
    }

    public function xlThamGia($ng_dung_id, $lop_hoc_id)
    {
        if ($ng_dung_id != null && $lop_hoc_id != null) {
            $temp = ChiTietLopHoc::where('lop_hoc_id', '=', $lop_hoc_id)
                ->where('nguoi_dung_id', '=', $ng_dung_id)
                ->where('trang_thai', '=', 1)->first();

            if ($temp == null) {
                $ctLopHoc = new ChiTietLopHoc();

                $ctLopHoc->lop_hoc_id = $lop_hoc_id;
                $ctLopHoc->nguoi_dung_id = $ng_dung_id;
                $ctLopHoc->trang_thai = true;
                $ctLopHoc->cach_tham_gia = true;

                $ctLopHoc->save();

                return "Tham gia lớp học thành công";
            } else
                return view('./errors/404');
        }
        return view('./errors/404');
    }

    public function xoaSinhVien(Request $req)
    {
        if ($req->lop_hoc_id != null && $req->nguoi_dung_id != null) {
            $user = ChiTietLopHoc::where('lop_hoc_id', '=', $req->lop_hoc_id)
                ->where('nguoi_dung_id', '=', $req->nguoi_dung_id);
            if ($user != null) {
                $user->delete();
                return redirect()->back()->with('success', 'Xoá thành công sinh viên khỏi lớp');
            } else
                return redirect()->back()->with('error', 'Thao tác thất bại');
        } else
            return redirect()->back()->with('error', 'Thao tác thất bại');
    }

    public function binhLuan(Request $req, $bai_dang_id, $lop_hoc_id)
    {
        
        if($req->user_comment != null || $req->user_comment != '')
        {
            $binhLuan  = new BinhLuan();

            $binhLuan->bai_dang_id = $bai_dang_id;
            $binhLuan->lop_hoc_id = $lop_hoc_id;
            $binhLuan->nguoi_dung_id = Auth::id();
            $binhLuan->noi_dung = $req->user_comment;

            $binhLuan->save();

            return redirect()->back()->with('success','Nhận xét thành công.');
        }
        else
            return redirect()->back()->with('error','Nhận xét thất bại.');
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
            $dsLop = [];

            $dsLop = NguoiDung::find($nguoi_dung_id)->dsLopHoc;

            foreach ($dsLop as $lop) {
                if ($lop->pivot->trang_thai == 2)
                    array_push($dsLop, $lop);
            }

            //Lấy thông tin lớp học hiện tại
            $lopHoc = LopHoc::find($lop_hoc_id);

            //Lấy bài đăng
            $baiDang = BaiDang::find($bai_dang_id);

            $cmt = BinhLuan::where('bai_dang_id', '=', $bai_dang_id)->get();

            if ($loai_bai_dang_id == 1 || $loai_bai_dang_id == 3) {
                return redirect()->back();
                //return view('./teacher/details-document', compact('lopHoc', 'dsLop', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }

            if ($loai_bai_dang_id == 2) {
                return redirect()->back();
                //return view('./teacher/details-homework', compact('lopHoc', 'dsLop', 'baiDang', 'cmt', 'bai_dang_id', 'loai_bai_dang_id'));
            }
        }
    }
}
