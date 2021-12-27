<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\LopHoc;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DangNhapRequest;
use Facade\FlareClient\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Mail;

class NguoiDungController extends Controller
{
    public function formDangNhap()
    {
        return view('index');
    }

    public function xuLyDangNhap(DangNhapRequest $request)
    {
        if (Auth::attempt(['ten_dang_nhap' => $request->username, 'password' => $request->password])) {
            $infor = Auth::user();
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'admin') == 0) {
                return redirect()->route('ad-trang-chu')->with('success','Đăng nhập thành công');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'sinh viên') == 0) {
                return redirect()->route('sv-trang-chu')->with('success','Đăng nhập thành công');
            }
            if (strcasecmp($infor->loaiNguoiDung->ten_loai, 'giảng viên') == 0) {;
                return redirect()->route('gv-trang-chu')->with('success','Đăng nhập thành công');
            }
        } else {
            $request->session()->flash('error', 'Sai tên tài khoản hoặc mật khẩu');
            return redirect()->route('dang-nhap');
        }
    }

    public function formQuenMatKhau()
    {
        return view('./login/forgot-password');
    }
    
    public function xlQuenMatKhau(Request $req)
    {
        $user = NguoiDung::where('email','=',$req->email_for_pass)->first();
        
        if($user != null)
        {
            $name = $user->ho_ten;
            $email_address = $user->email;

            $data=[
                'id' =>$user->id,
                'name' => $user->ho_ten,
                'token' => $user->token,
            ];

            Mail::send('./mails/forgot-password',compact('data'),function($email) use($name, $email_address){
                $email->subject('Liên kết đặt lại mật khẩu của bạn');
                $email->to($email_address,$name);
            });

            return redirect()->back()->with('success','Đã gửi 1 liên kết đến Email của bạn. Vui lòng kiểm tra Email.');
        }
        else
        {
            return redirect()->back()->with('error','Email này chưa được đăng ký trong hệ thống');
        }
    }

    public function getNewPassword($id,$token)
    {
        if($id != null && $token != null)
        {
            $user = NguoiDung::find($id);
            if(strcmp($user->token,$token) == 0)
            {
                $nguoi_dung_id = $id;
                $nguoi_dung_token = $token;

                return view('./login/get-new-password',['id' => "$nguoi_dung_id", 'token' => "$nguoi_dung_token"]);
            }
            else
                return redirect('./errors/404'); 
        }
        return redirect('./errors/404');
    }

    public function xlGetNewPassword(Request $req, $id, $token)
    {
        if($req->new_password != null && $req->cf_new_password != null)
        {
            if(strcmp($req->new_password, $req->cf_new_password) == 0)
            {
                $user = NguoiDung::find($id);
                
                $user->password = Hash::make($req->new_password);
                $user->token = Str::random(10);

                $user->save();
                return redirect()->route('dang-nhap')->with('success','Đặt lại mật khẩu thành công.');
            }
            else
                return redirect()->back()->with('error','Xác nhận mật khẩu mới không đúng');
        }
        else
            return redirect()->back()->with('error','Hãy nhập đầy đủ thông tin');
    }

    //LONG

    // public function LayDSGV()
    // {
    //     $dsGV = NguoiDung::all()->where('loai_nguoi_dung_id', '2');
    //     return view('./layouts/admin/teacher/index', compact('dsGV'));
    // }
    // public function formThemMoi()
    // {
    //     return view('./layouts/admin/teacher/create');
    // }
    // public function xlThemMoi(Request $rq)
    // {
    //     $ngdung = new NguoiDung();
    //     $ngdung->ten_dang_nhap = $rq->ten_dang_nhap;
    //     $ngdung->password = $rq->password;
    //     $ngdung->ho_ten = $rq->ho_ten;
    //     $ngdung->ngay_sinh = $rq->ngay_sinh;
    //     if ($rq->gioi_tinh == "Nam") {
    //         $ngdung->gioi_tinh = $rq->gioi_tinh;
    //     } else if ($rq->gioi_tinh == "Nữ") {
    //         $ngdung->gioi_tinh = $rq->gioi_tinh;
    //     }
    //     $ngdung->dia_chi = $rq->dia_chi;
    //     $ngdung->sdt = $rq->sdt;
    //     $ngdung->email = $rq->email;
    //     $ngdung->loai_nguoi_dung_id = 2;
    //     $ngdung->save();
    //     return redirect()->route('ds_giang_vien');
    // }
}
