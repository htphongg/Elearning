<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // for($i = 1 ; $i <= 10;$i++){
        //     DB::table('lop_hoc')->insert([
        //         'ten_lop'=>"Lop {$i}",
        //         'trang_thai' => true
        //     ]);
        // }
        for ($i = 1; $i <= 3; $i++) {
            $_Lop = new LopHoc();
            $_Lop->ma_lop = Str::random(6);
            $_Lop->ten_lop = "CDTH19PMC";
            $_Lop->mo_ta = "HK1 NH 2021";
            $_Lop->anh_nen_id = 1;
            $_Lop->save();
        }
    }
}
