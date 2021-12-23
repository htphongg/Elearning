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
            $table->string('gioi_tinh')->default('Nam');
            $table->string('dia_chi');
            $table->string('sdt');
            $table->string('email');
            $table->string('ten_dang_nhap');
            $table->string('password');
            $table->integer('loai_nguoi_dung_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loai_nguoi_dung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_loai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('phong_cho_lop_hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nguoi_dung_id');
            $table->integer('lop_hoc_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loai_bai_dang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_loai');
            $table->timestamps();
            $table->softDeletes();
        });

        //Khoa
        Schema::create('chi_tiet_lop_hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lop_hoc_id');
            $table->integer('nguoi_dung_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('anh_nen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_anh');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bai_nop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_dang_id');
            $table->integer('nguoi_dung_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lop_hoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ma_lop');
            $table->string('ten_lop');
            $table->string('mo_ta');
            $table->string('anh_nen_id');
            $table->timestamps();
            $table->softDeletes();
        });

        //Long
        Schema::create('bai_dang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->string('noi_dung');
            $table->datetime('han_nop');
            $table->integer('loai_bai_dang_id');
            $table->integer('lop_hoc_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('binh_luan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_dang_id');
            $table->integer('nguoi_dung_id');
            $table->string('noi_dung');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_binh_luan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('binh_luan_id');
            $table->string('dinh_kem');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_bai_dang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_dang_id');
            $table->string('dinh_kem');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_bai_nop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bai_nop_id');
            $table->string('dinh_kem');
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

        Schema::dropIfExists('loai_nguoi_dung');

        Schema::dropIfExists('phong_cho_lop_hoc');

        Schema::dropIfExists('loai_bai_dang');

        //Khoa
        Schema::dropIfExists('chi_tiet_lop_hoc');

        Schema::dropIfExists('anh_nen');

        Schema::dropIfExists('bai_nop');

        Schema::dropIfExists('lop_hoc');

        //Long
        Schema::dropIfExists('bai_dang');

        Schema::dropIfExists('binh_luan');

        Schema::dropIfExists('dinh_kem_binh_luan');

        Schema::dropIfExists('dinh_kem_bai_dang');

        Schema::dropIfExists('dinh_kem_bai_nop');
    }
}
