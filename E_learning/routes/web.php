<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Star - Phong

//Problems
   //đăng nhập tư cách là sinh viên nhưng vẫn route dc vào giảng viên
   //Chứng thực xong vẫn có thể lui về trang đăng nhập


//Đăng nhập
Route::get('/', [NguoiDungController::class,'formDangNhap'])->name('dang-nhap')->middleware('guest');
Route::post('/', [NguoiDungController::class,'xuLyDangNhap'])->name('xl-dang-nhap');
Route::get('/forgot-password',[NguoiDungController::class,'formQuenMatKhau'])->name('quen-mat-khau');


Route::middleware(['auth'])->group(function () {
    //Sinh viên
    Route::get('/student',function(){
        return view('.layouts/student/index');
    })->name('trang-chu-sinh-vien')->middleware('auth');

    //Giảng viên
    Route::get('/teacher',function(){
        return view('.layouts/teacher/index');
    })->name('trang-chu-giang-vien');

    //Admin
    Route::get('/admin',function(){
        return view('./layouts/admin/index');
    })->name('trang-chu-admin');

    //Cập nhật thông tin cá nhân
    Route::get('/cap-nhat-thong-tin', [NguoiDungController::class, 'formCapNhatThongTinCaNhan'])->name('cap-nhat-thong-tin');
    Route::post('/cap-nhat-thong-tin', [NguoiDungController::class, 'xuLyCapNhatThongTinCaNhan'])->name('xl-cap-nhat-thong-tin');

    //Đổi mật khẩu
    Route::get('/doi-mat-khau',[NguoiDungController::class,'formDoiMatKhau'])->name('doi-mat-khau');
    Route::post('/doi-mat-khau',[NguoiDungController::class,'xuLyDoiMatKhau'])->name('xl-doi-mat-khau');

    //Đăng xuất
    Route::get('/dang-xuat',[NguoiDungController::class,'dangXuat'])->name('dang-xuat');
});

//End - Phong