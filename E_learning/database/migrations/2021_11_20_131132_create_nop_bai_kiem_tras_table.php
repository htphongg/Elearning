<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNopBaiKiemTrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nop_bai_kiem_tra', function (Blueprint $table) {
            $table->bitInteger('id');
            $table->integer('ma_bai_kt');
            $table->integer('ma_nguoi_kt');
            $table->float('diem');
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
        Schema::dropIfExists('nop_bai_kiem_tra');
    }
}
