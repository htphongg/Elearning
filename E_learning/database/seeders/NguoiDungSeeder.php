<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ngDung = new NguoiDung();
        $ngDung->ho_ten = 'Huỳnh Nhật Khoa';
        $ngDung->ngay_sinh = '2001-3-7';
        $ngDung->gioi_tinh = 'Nam';
        $ngDung->dia_chi = 'Hồ Chí Minh';
        $ngDung->sdt = '0000000000';
        $ngDung->email = 'hnkhoa@gmail.vn';
        $ngDung->ten_dang_nhap = 'hnkhoa';
        $ngDung->password = Hash::make('123456');
        $ngDung->loai_nguoi_dung_id = 3;
        $ngDung->save();
        // $ngDung = new NguoiDung();
<<<<<<< HEAD
        // $ngDung->ho_ten = 'Trần Thanh Tuấn';
        // $ngDung->ngay_sinh = '1969-11-17';
        // $ngDung->gioi_tinh = 'Nam';
        // $ngDung->dia_chi = 'Hồ Chí Minh';
        // $ngDung->sdt = '0000000000';
        // $ngDung->email = 'tttuan@caothang.edu.vn';
        // $ngDung->ten_dang_nhap = 'tttuan';
=======
        // $ngDung->ho_ten = 'Nguyễn Thị Ngọc';
        // $ngDung->ngay_sinh = '1980-1-1';
        // $ngDung->gioi_tinh = 'Nữ';
        // $ngDung->dia_chi = 'kh biết';
        // $ngDung->sdt = '0000000000';
        // $ngDung->email = 'ntngoc@gmail.vn';
        // $ngDung->ten_dang_nhap = 'ntngoc';
>>>>>>> main
        // $ngDung->password = Hash::make('123456');
        // $ngDung->loai_nguoi_dung_id = 2;
        // $ngDung->save();
    }
}
