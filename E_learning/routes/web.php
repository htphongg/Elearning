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
//Đăng nhập
Route::get('/', [NguoiDungController::class, 'formDangNhap'])->name('dang-nhap')->middleware('guest');
Route::post('/', [NguoiDungController::class, 'xuLyDangNhap'])->name('xl-dang-nhap')->middleware('guest');
Route::get('/forgot-password', [NguoiDungController::class, 'formQuenMatKhau'])->name('quen-mat-khau')->middleware('guest');
Route::post('/forgot-password', [NguoiDungController::class, 'xlQuenMatKhau'])->name('xl-quen-mat-khau')->middleware('guest');
Route::get('reset-password/{a}/{b}', [NguoiDungController::class, 'getNewPassword'])->name('dat-lai-mat-khau')->middleware('guest');
Route::post('reset-password/{a}/{b}', [NguoiDungController::class, 'xlGetNewPassword'])->name('xl-dat-lai-mat-khau')->middleware('guest');


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
        Route::get('/tham-gia-lop', [SinhVienController::class, 'thamGiaLop'])->name('sv-tham-gia-lop');
        Route::post('/tham-gia-lop', [SinhVienController::class, 'xlthamGiaLop'])->name('sv-xl-tham-gia-lop');

        //Rời lớp
        Route::get('/roi-lop', [SinhVienController::class, 'roiLop'])->name('sv-roi-lop');

        //Xem chi tiết bài đăng
        Route::get('/chi-tiet-bai-dang/{id}/{type}', [SinhVienController::class, 'xemChiTietBaiDang'])->name('sv-chi-tiet-bai-dang');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', [SinhVienController::class, 'showChiTietLop'])->name('sv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', [SinhVienController::class, 'showCongViec'])->name('sv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', [SinhVienController::class, 'showTatCaThanhVien'])->name('sv-moi-nguoi');

        //Viết bình luận
        Route::post('/binh-luan/{id}/{type}', [SinhVienController::class, 'vietBinhLuan'])->name('sv-binh-luan');

        //Đăng xuất
        Route::get('/dang-xuat', [SinhVienController::class, 'dangXuat'])->name('sv-dang-xuat');

        // //Bình luận
        // Route::post('/binh-luan/{bai_dang_id}/{lop_hoc_id}', [SinhVienController::class, 'vietBinhLuan'])->name('sv-binh-luan');
    });

    //Giảng viên
    Route::middleware('teacher.check')->prefix('teacher')->group(function () {
        //Trang chủ
        Route::get('/', [GiangVienController::class, 'layDsLop'])->name('gv-trang-chu');

        //Tạo lớp học
        Route::get('/tao-lop', [GiangVienController::class, 'taoLop'])->name('gv-tao-lop');
        Route::post('/tao-lop', [GiangVienController::class, 'xlTaoLop'])->name('gv-xl-tao-lop');

        //Chỉnh sửa thông tin lớp học
        Route::get('/chinh-sua-lop', [GiangVienController::class, 'chinhSuaLop'])->name('gv-chinh-sua-lop');
        Route::post('/chinh-sua-lop', [GiangVienController::class, 'xlChinhSuaLop'])->name('gv-xl-chinh-sua-lop');

        //Lưu trữ (Xoá) lớp học
        Route::get('/xoa-lop-hoc', [GiangVienController::class, 'xoaLopHoc'])->name('gv-xoa-lop');

        //Danh sách lớp học lưu trữ
        Route::get('/lop-hoc-luu-tru', [GiangVienController::class, 'dsLopHocLuuTru'])->name('gv-ds-lop-luu-tru');

        //Phòng chờ lớp học
        Route::get('/phong-cho', [GiangVienController::class, 'phongCho'])->name('gv-phong-cho-lop-hoc');
        Route::get('/phong-cho/{lop_id}/{ngd_id}/{tacvu}', [GiangVienController::class, 'xlPhongCho'])->name('gv-xl-phong-cho-lop-hoc');

        //Gửi mail mời tham gia lớp học
        Route::get('/moi-tham-gia', [GiangVienController::class, 'formMoiThamGia'])->name('gv-moi-tham-gia');
        Route::post('/moi-tham-gia', [GiangVienController::class, 'xlMoiThamGia'])->name('gv-xl-moi-tham-gia');
        Route::get('/xl-tham-gia/{id}/{lop_id}', [GiangVienController::class, 'xlThamGia'])->name('gv-xl-tham-gia');

        //Xoá sinh viên khỏi lớp
        Route::get('/xoa-sinh-vien', [GiangVienController::class, 'xoaSinhVien'])->name('gv-xoa-sinh-vien');

        //Đăng bài
        Route::get('/dang-bai/lop/{lop_hoc_id}', [GiangVienController::class, 'formDangBai'])->name('gv-dang-bai');
        Route::post('/dang-bai/lop/{lop_hoc_id}', [GiangVienController::class, 'xlDangBai'])->name('gv-xl-dang-bai');

        //Xem chi tiết bài
        Route::get('/chi-tiet-bai-dang/{id}/{type}', [GiangVienController::class, 'xemChiTietBaiDang'])->name('gv-chi-tiet-bai-dang');

        //Cập nhật bài
        Route::get('/chinh_sua_bai/{id}', [GiangVienController::class, 'formChinhSuaBaiDang'])->name('gv-chinh-sua-bai-dang');
        Route::post('/chinh_sua_bai/{id}', [GiangVienController::class, 'xlChinhSuaBaiDang'])->name('gv-xl-chinh-sua-bai-dang');

        //Xoá bài
        Route::get('/xoa-bai', [GiangVienController::class, 'xoaBaiDang'])->name('gv-xoa-bai');

        //Cập nhật thông tin cá nhân
        Route::get('/cap-nhat-thong-tin', [GiangVienController::class, 'formCapNhatThongTinCaNhan'])->name('gv-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [GiangVienController::class, 'xuLyCapNhatThongTinCaNhan'])->name('gv-xl-cap-nhat-thong-tin');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [GiangVienController::class, 'formDoiMatKhau'])->name('gv-doi-mat-khau');
        Route::post('/doi-mat-khau', [GiangVienController::class, 'xuLyDoiMatKhau'])->name('gv-xl-doi-mat-khau');

        //Chi tiết lớp
        Route::get('/chi-tiet-lop', [GiangVienController::class, 'showChiTietLop'])->name('gv-chi-tiet-lop');

        //Công việc cần làm
        Route::get('/cong-viec', [GiangVienController::class, 'showCongViec'])->name('gv-cong-viec');

        //Mọi người
        Route::get('/moi-nguoi', [GiangVienController::class, 'showTatCaThanhVien'])->name('gv-moi-nguoi');

        //Viết bình luận
        Route::post('/binh-luan/{id}/{type}', [GiangVienController::class, 'vietBinhLuan'])->name('gv-binh-luan');

        // //Bình luận
        // Route::post('/binh-luan/{bai_dang_id}/{lop_hoc_id}',[GiangVienController::class,'binhLuan'])->name('gv-binh-luan'); 

        //Đăng xuất
        Route::get('/dang-xuat', [GiangVienController::class, 'dangXuat'])->name('gv-dang-xuat');
    });

    //Admin
    Route::middleware('admin.check')->prefix('admin')->group(function () {
        //Trang chủ
        Route::get('/', function () {
            return view('./admin/index');
        })->name('ad-trang-chu');
        // Route::get('/', [AdminController::class, 'LayThongtin'])->name('ad-thong-tin');
        //Load danh sách giảng viên
        Route::get('/ds_giang_vien', [AdminController::class, 'LayDSGV'])->name('ad-ds-giang-vien');

        //Thêm mới giảng viên
        Route::get('/them_moi_gv', [AdminController::class, 'formThemMoiGV'])->name('ad-them-moi-gv');
        Route::post('/them_moi_gv', [AdminController::class, 'xlThemMoiGV'])->name('ad-xl-them-moi-gv');

        //Cập nhật giảng viên
        Route::get('/cap_nhat_gv/{id}', [AdminController::class, 'formCapNhatGV'])->name('ad-cap-nhat-gv');
        Route::post('/cap_nhat_gv/{id}', [AdminController::class, 'xlCapnhatGV'])->name('ad-xl-cap-nhat-gv');

        //Xóa giảng viên
        Route::get('/xoa_bo_gv/{id}', [AdminController::class, 'xlXoaGV'])->name('ad-xoa-bo-gv');

        // //Load danh sách sinh viên
        Route::get('/ds_sinh_vien', [AdminController::class, 'LayDSSV'])->name('ad-ds-sinh-vien');

        // //Thêm mới giảng viên
        Route::get('/them_moi_sv', [AdminController::class, 'formThemMoiSV'])->name('ad-them-moi-sv');
        Route::post('/them_moi_sv', [AdminController::class, 'xlThemMoiSV'])->name('ad-xl-them-moi-sv');

        //Cập nhật sinh viên
        Route::get('/cap_nhat_sv/{id}', [AdminController::class, 'formCapNhatSV'])->name('ad-cap-nhat-sv');
        Route::post('/cap_nhat_sv/{id}', [AdminController::class, 'xlCapnhatSV'])->name('ad-xl-cap-nhat-sv');

        //Xóa bỏ sinh viên
        Route::get('/xoa_bo_sv/{id}', [AdminController::class, 'xlXoaSV'])->name('ad-xoa-bo-sv');

        //Load DS Lớp
        Route::get('/ds_lop', [AdminController::class, 'LayDSLop'])->name('ad-ds-lop');

        //Thêm mới lớp
        Route::get('/them_moi_lh', [AdminController::class, 'formThemMoiLH'])->name('ad-them-moi-lh');
        Route::post('/them_moi_lh', [AdminController::class, 'xlThemMoiLH'])->name('ad-xl-them-moi-lh');

        //Cập nhật lớp
        Route::get('/cap_nhat_lh/{id}', [AdminController::class, 'formCapNhatLH'])->name('ad-cap-nhat-lh');
        Route::post('/cap_nhat_lh/{id}', [AdminController::class, 'xlCapnhatLH'])->name('ad-xl-cap-nhat-lh');

        //Xóa bỏ lớp
        Route::get('/xoa_bo_lh/{id}', [AdminController::class, 'xlXoaLH'])->name('ad-xoa-bo-lh');

        //Chi tiết lớp
        Route::get('/chi_tiet_lop/{id}', [AdminController::class, 'XemChiTietLop'])->name('ad-chi-tiet-lop');

        //Load DS Bài Đăng
        Route::get('/ds_bai_dang', [AdminController::class, 'LayDSBaiDang'])->name('ad-ds-bai-dang');

        //Lọc
        Route::post('/ds_bai_dang', [AdminController::class, 'LocDuLieu'])->name('ad-loc');

        //Xem Chi Tiết Bài Đăng
        Route::get('/chi_tiet_bai_dang/{id}', [AdminController::class, 'XemChiTietBaiDang'])->name('ad-chi-tiet-bai-dang');

        //Cập nhật thông tin cá nhân admin
        Route::get('/cap-nhat-thong-tin', [AdminController::class, 'formCapNhatThongTinCaNhan'])->name('ad-cap-nhat-thong-tin');
        Route::post('/cap-nhat-thong-tin', [AdminController::class, 'xuLyCapNhatThongTinCaNhan'])->name('ad-xl-cap-nhat-thong-tin');

        //Xóa bỏ bài đăng
        Route::get('/xoa_bo_bd/{id}', [AdminController::class, 'xlXoaBaiDang'])->name('ad-xoa-bo-bd');

        //Đổi mật khẩu
        Route::get('/doi-mat-khau', [AdminController::class, 'formDoiMatKhau'])->name('ad-doi-mat-khau');
        Route::post('/doi-mat-khau', [AdminController::class, 'xuLyDoiMatKhau'])->name('ad-xl-doi-mat-khau');

        //Đăng xuất
        Route::get('/dang-xuat', [AdminController::class, 'dangXuat'])->name('ad-dang-xuat');
    });
});

//End - Phong
