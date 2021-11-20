<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangDiemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bang_diem', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('id_lop');
            $table->integer('diem_chuyen_can');
            $table->integer('id_nop_btvn');
            $table->integer('id_nop_bai_kt');
            $table->float('tong_ket', 3, 1);
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
        Schema::dropIfExists('bang_diem');
    }
}
