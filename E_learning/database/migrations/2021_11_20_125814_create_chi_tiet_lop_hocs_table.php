<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietLopHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_lop_hoc', function (Blueprint $table) {
            $table->bitInteger('id');
            $table->integer('ma_lop');
            $table->integer('ma_bai_giang');
            $table->integer('ma_bai_tap');
            $table->integer('ma_bai_kiem_tra');
            $table->integer('ma_thong_bao');
            $table->integer('ma_nguoi_dung');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_lop_hoc');
    }
}
