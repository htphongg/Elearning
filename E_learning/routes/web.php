<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\ThemLopMoiController;
use App\Http\Controllers\SinhVien\SinhVienController;

/*
|---------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|-----------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/





//Start - Phong

//Problems
//Chưa kiểm tra dc sv đã vào lớp học hay chưa
// Mã lớp có tồn tại kh
//Chứng thực xong vẫn có thể lui về trang đăng nhập


//Đăng nhập
Route::get('/', [NguoiDungController::class, 'formDangNhap'])->name('dang-nhap')->middleware('guest');
Route::get('/forgot-password', [NguoiDungController::class, 'formQuenMatKhau'])->name('quen-mat-khau')->middleware('guest');
Route::post('/', [NguoiDungController::class, 'xuLyDangNhap'])->name('xl-dang-nhap')->middleware('guest');


Route::middleware(['auth'])->group(function () {
    //Sinh viên
    Route::middleware('student.check')->prefix('student')->group(function () {
        //Trang chủ
        Route::get('/', [NguoiDungController::class, 'layDsLop'])->name('sv-trang-chu');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [NguoiDungController::class, 'formCapNhatThongTinCaNhan'])->name('sv-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [NguoiDungController::class, 'xuLyCapNhatThongTinCaNhan'])->name('sv-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [NguoiDungController::class, 'formDoiMatKhau'])->name('sv-doi-mat-khau');
        Route::post('/doi-mat-khau', [NguoiDungController::class, 'xuLyDoiMatKhau'])->name('sv-xl-doi-mat-khau');

        //Tham gia lớp học
        Route::get('/them_lop', [SinhVienController::class, 'thamGiaLop'])->name('sv-tham-gia-lop');
        Route::post('/them_lop', [SinhVienController::class, 'xlthamGiaLop'])->name('sv-xl-tham-gia-lop');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', [NguoiDungController::class, 'showChiTietLop'])->name('sv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', [NguoiDungController::class, 'showCongViec'])->name('sv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', [NguoiDungController::class, 'showTatCaThanhVien'])->name('sv-moi-nguoi');

        //Đăng xuất
        Route::get('/dang-xuat', [NguoiDungController::class, 'dangXuat'])->name('sv-dang-xuat');
    });

    //Giảng viên
    Route::middleware('teacher.check')->prefix('teacher')->group(function () {

        //Trang chủ
        Route::get('/', function () {
            return view('.layouts/teacher/index');
        })->name('gv-trang-chu');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [NguoiDungController::class, 'formCapNhatThongTinCaNhan'])->name('gv-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [NguoiDungController::class, 'xuLyCapNhatThongTinCaNhan'])->name('gv-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [NguoiDungController::class, 'formDoiMatKhau'])->name('gv-doi-mat-khau');
        Route::post('/doi-mat-khau', [NguoiDungController::class, 'xuLyDoiMatKhau'])->name('gv-xl-doi-mat-khau');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', function () {
            return view('./layouts/teacher/class');
        })->name('gv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', function () {
            return view('./layouts/teacher/work');
        })->name('gv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', function () {
            return view('./layouts/teacher/everybody');
        })->name('gv-moi-nguoi');

        //Đăng xuất
        Route::get('/dang-xuat', [NguoiDungController::class, 'dangXuat'])->name('gv-dang-xuat');
    });

    //Admin
    Route::middleware('admin.check')->prefix('admin')->group(function () {
        //Trang chủ
        Route::get('/', function () {
            return view('./layouts/admin/index');
        })->name('ad-trang-chu');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [NguoiDungController::class, 'formCapNhatThongTinCaNhan'])->name('ad-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [NguoiDungController::class, 'xuLyCapNhatThongTinCaNhan'])->name('ad-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [NguoiDungController::class, 'formDoiMatKhau'])->name('ad-doi-mat-khau');
        Route::post('/doi-mat-khau', [NguoiDungController::class, 'xuLyDoiMatKhau'])->name('ad-xl-doi-mat-khau');

        //Đăng xuất
        Route::get('/dang-xuat', [NguoiDungController::class, 'dangXuat'])->name('ad-dang-xuat');
    });
});

//End - Phong

//Start - Long

Route::get('/admin/ds_giang_vien', [NguoiDungController::class, 'LayDSGV'])->name('ds_giang_vien');
Route::get('/admin/them_moi', [NguoiDungController::class, 'formThemMoi'])->name('them_moi');
Route::post('/admin/them_moi', [NguoiDungController::class, 'xlThemMoi'])->name('xl_them_moi');
