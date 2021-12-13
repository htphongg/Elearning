<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DBElearning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Phong
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ho_ten');
            $table->date('ngay_sinh');
            $table->string('gioi_tinh');
            $table->string('dia_chi');
            $table->string('sdt');
            $table->string('email');
            $table->integer('loai_nguoi_dung_id');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_dang_nhap');
            $table->string('mat_khau');
            $table->integer('nguoi_dung_id');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loai_nguoi_dung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_loai');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('thong_bao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->string('noi_dung');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        //Khoa
        Schema::create('chi_tiet_lop_hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lop_hoc_id');
            $table->integer('bai_giang_id');
            $table->integer('bai_tap_id');
            $table->integer('bai_kiem_tra_id');
            $table->integer('thong_bao_id');
            $table->integer('nguoi_dung_id');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bai_kiem_tra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->integer('noi_dung');
            $table->dateTime('han_nop');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('nop_bai_kiem_tra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_kiem_tra_id');
            $table->integer('nguoi_dung_id');
            $table->float('diem',3,1);
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lop_hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_lop');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        //Long
        Schema::create('bang_diem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lop_hoc_id');
            $table->integer('diem_chuyen_can');
            $table->integer('nop_bai_tap_id');
            $table->integer('nop_bai_kiem_tra_id');
            $table->float('tong_ket', 3, 1);
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bai_tap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->string('noi_dung');
            $table->dateTime('han_nop');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('nop_bai_tap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_tap_id');
            $table->integer('nguoi_dung_id');
            $table->float('diem', 3, 1);
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bai_giang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->string('noi_dung');
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
        //Phong
        Schema::dropIfExists('nguoi_dung');

        Schema::dropIfExists('tai_khoan');

        Schema::dropIfExists('loai_nguoi_dung');

        Schema::dropIfExists('thong_bao');

        //Khoa
        Schema::dropIfExists('chi_tiet_lop_hoc');

        Schema::dropIfExists('bai_kiem_tra');

        Schema::dropIfExists('nop_bai_kiem_tra');

        Schema::dropIfExists('lop_hoc');

        //Long
        Schema::dropIfExists('bang_diem');

        Schema::dropIfExists('bai_tap');

        Schema::dropIfExists('nop_bai_tap');

        Schema::dropIfExists('bai_giang');
    }
}
