<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\SinhVien\SinhVienController;
use App\Http\Controllers\GiangVien\GiangVienController;
use App\Http\Controllers\Admin\AdminController;

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
        Route::get('/', [SinhVienController::class, 'layDsLop'])->name('sv-trang-chu');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [SinhVienController::class, 'formCapNhatThongTinCaNhan'])->name('sv-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [SinhVienController::class, 'xuLyCapNhatThongTinCaNhan'])->name('sv-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [SinhVienController::class, 'formDoiMatKhau'])->name('sv-doi-mat-khau');
        Route::post('/doi-mat-khau', [SinhVienController::class, 'xuLyDoiMatKhau'])->name('sv-xl-doi-mat-khau');

        //Tham gia lớp học
        Route::get('/them_lop', [SinhVienController::class, 'thamGiaLop'])->name('sv-tham-gia-lop');
        Route::post('/them_lop', [SinhVienController::class, 'xlthamGiaLop'])->name('sv-xl-tham-gia-lop');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', [SinhVienController::class, 'showChiTietLop'])->name('sv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', [SinhVienController::class, 'showCongViec'])->name('sv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', [SinhVienController::class, 'showTatCaThanhVien'])->name('sv-moi-nguoi');

        //Đăng xuất
        Route::get('/dang-xuat', [SinhVienController::class, 'dangXuat'])->name('sv-dang-xuat');
    });

    //Giảng viên
    Route::middleware('teacher.check')->prefix('teacher')->group(function () {

        //Trang chủ
        Route::get('/', [GiangVienController::class, 'layDsLop'])->name('gv-trang-chu');

        //Tạo lớp học
        Route::get('/tao-lop', [GiangVienController::class, 'taoLop'])->name('gv-tao-lop');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [GiangVienController::class, 'formCapNhatThongTinCaNhan'])->name('gv-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [GiangVienController::class, 'xuLyCapNhatThongTinCaNhan'])->name('gv-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [GiangVienController::class, 'formDoiMatKhau'])->name('gv-doi-mat-khau');
        Route::post('/doi-mat-khau', [GiangVienController::class, 'xuLyDoiMatKhau'])->name('gv-xl-doi-mat-khau');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', function () {
            return view('./teacher/class');
        })->name('gv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', function () {
            return view('./teacher/work');
        })->name('gv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', function () {
            return view('./teacher/everybody');
        })->name('gv-moi-nguoi');

        //Đăng xuất
        Route::get('/dang-xuat', [GiangVienController::class, 'dangXuat'])->name('gv-dang-xuat');
    });

    //Admin
    Route::middleware('admin.check')->prefix('admin')->group(function () {
        //Trang chủ
        Route::get('/', function () {
            return view('./admin/index');
        })->name('ad-trang-chu');

        //Load danh sách giảng viên
        Route::get('/ds_giang_vien', [AdminController::class, 'LayDSGV'])->name('ad-ds-giang-vien');

        //Thêm mới giảng viên
        Route::get('/them_moi_gv', [AdminController::class, 'formThemMoiGV'])->name('ad-them-moi-gv');
        Route::post('/them_moi_gv', [AdminController::class, 'xlThemMoiGV'])->name('ad-xl-them-moi-gv');

        //Cập nhật giảng viên
        Route::get('/cap_nhat_gv/{id}', [AdminController::class, 'formCapNhatGV'])->name('ad-cap-nhat-gv');

        //Xóa giảng viên
        Route::get('/xoa_bo_gv/{id}', [AdminController::class, 'xlXoaGV'])->name('ad-xoa-bo-gv');


        // //Load danh sách sinh viên
        Route::get('/ds_sinh_vien', [AdminController::class, 'LayDSSV'])->name('ad-ds-sinh-vien');

        // //Thêm mới giảng viên
        Route::get('/them_moi_sv', [AdminController::class, 'formThemMoiSV'])->name('ad-them-moi-sv');
        Route::post('/them_moi_sv', [AdminController::class, 'xlThemMoiSV'])->name('ad-xl-them-moi-sv');

        //Cập nhật sinh viên
        Route::get('/cap_nhat_sv/{id}', [AdminController::class, 'formCapNhatSV'])->name('ad-cap-nhat-sv');

        //Xóa bỏ sinh viên
        Route::get('/xoa_bo_sv/{id}', [AdminController::class, 'xlXoaSV'])->name('ad-xoa-bo-sv');

        //Load DS Lớp
        Route::get('/ds_lop', [AdminController::class, 'LayDSLop'])->name('ad-ds-lop');

        //Thêm mới giảng viên
        Route::get('/them_moi_lh', [AdminController::class, 'formThemMoiLH'])->name('ad-them-moi-lh');
        Route::post('/them_moi_lh', [AdminController::class, 'xlThemMoiLH'])->name('ad-xl-them-moi-lh');

        //Cập nhật sinh viên
        Route::get('/cap_nhat_lh/{id}', [AdminController::class, 'formCapNhatLH'])->name('ad-cap-nhat-lh');

        //Xóa bỏ sinh viên
        Route::get('/xoa_bo_lh/{id}', [AdminController::class, 'xlXoaLH'])->name('ad-xoa-bo-lh');

        //Cập nhật thông tin cá nhân admin
        Route::get('/cap-nhat-thong-tin', [NguoiDungController::class, 'formCapNhatThongTinCaNhan'])->name('ad-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [NguoiDungController::class, 'xuLyCapNhatThongTinCaNhan'])->name('ad-xl-cap-nhat-thong-tin');


        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [NguoiDungController::class, 'formDoiMatKhau'])->name('ad-doi-mat-khau');
        Route::post('/doi-mat-khau', [NguoiDungController::class, 'xuLyDoiMatKhau'])->name('ad-xl-doi-mat-khau');

        //Đăng xuất
        Route::get('/dang-xuat', [AdminController::class, 'dangXuat'])->name('ad-dang-xuat');
    });
});

//End - Phong
