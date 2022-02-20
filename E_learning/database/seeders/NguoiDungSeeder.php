<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $ngDung->ho_ten = 'Giảng Viên Clone';
        $ngDung->ngay_sinh = '2001-1-1';
        $ngDung->gioi_tinh = 'Nam';
        $ngDung->dia_chi = 'Hồ Chí Minh';
        $ngDung->sdt = '65653';
        $ngDung->email = 'gvclone@caothang.edu.vn';
        $ngDung->ten_dang_nhap = 'gvclone';
        $ngDung->password = Hash::make('123456');
        $ngDung->token = Str::random(10);
        $ngDung->loai_nguoi_dung_id = 2;
        $ngDung->save();
    }
}
