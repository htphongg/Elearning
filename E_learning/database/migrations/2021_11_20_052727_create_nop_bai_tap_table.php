<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNopBaiTapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nop_bai_tap', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('id_bai_tap');
            $table->integer('id_nguoi_dung');
            $table->float('diem', 3, 1);
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
        Schema::dropIfExists('nop_bai_tap');
    }
}
