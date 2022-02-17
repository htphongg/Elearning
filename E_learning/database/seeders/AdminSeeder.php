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
        $ngDung->gioi_tinh = 'Không biết';
        $ngDung->dia_chi = 'Không biết';
        $ngDung->sdt = '0000000000';
        $ngDung->email = 'admin@gmail.com';
        $ngDung->ten_dang_nhap = 'admin';
        $ngDung->password = Hash::make('123456');
        $ngDung->loai_nguoi_dung_id = 0;
        $ngDung->save();
    }
}
