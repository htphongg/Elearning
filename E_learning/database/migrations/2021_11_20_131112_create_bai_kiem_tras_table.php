<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaiKiemTrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_kiem_tra', function (Blueprint $table) {
            $table->bitInteger('id');
            $table->string('tieu_de');
            $table->integer('noi_dung');
            $table->float('thoi_han');
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
        Schema::dropIfExists('bai_kiem_tra');
    }
}
