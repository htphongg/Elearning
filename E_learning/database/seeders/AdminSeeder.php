<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ngDung = new NguoiDung();
        $ngDung->ho_ten = 'Admin';
        $ngDung->ngay_sinh = '2000-1-1';
        $ngDung->gioi_tinh = 'Khác';
        $ngDung->dia_chi = 'Hồ Chí Minh';
        $ngDung->sdt = '0000000000';
        $ngDung->email = 'admin@gmail.vn';
        $ngDung->ten_dang_nhap = 'admin';
        $ngDung->password = Hash::make('123456');
        $ngDung->loai_nguoi_dung_id = 1;
        $ngDung->save();
    }
}
