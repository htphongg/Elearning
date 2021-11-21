<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1 ; $i <= 10;$i++){
            DB::table('lop_hoc')->insert([
                'ten_lop'=>"Lop {$i}",
                'trang_thai' => true
            ]);
        }
    }
}
