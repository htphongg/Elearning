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
            $table->increments('id');
            $table->string('ho_ten');
            $table->date('ngay_sinh');
            $table->string('gioi_tinh')->default('Nam');
            $table->string('dia_chi');
            $table->string('sdt')->unique();
            $table->string('email')->unique();
            $table->string('ten_dang_nhap')->unique();
            $table->string('password');
            $table->string('token')->unique()->nullable($value =true);
            $table->integer('loai_nguoi_dung_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loai_nguoi_dung', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_loai')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        // Schema::create('phong_cho_lop_hoc', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('nguoi_dung_id');
        //     $table->integer('lop_hoc_id');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        Schema::create('loai_bai_dang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_loai');
            $table->timestamps();
            $table->softDeletes();
        });

        //Khoa
        Schema::create('chi_tiet_lop_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lop_hoc_id');
            $table->integer('nguoi_dung_id');
            $table->boolean('trang_thai');
            $table->boolean('cach_tham_gia');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('anh_nen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_anh')->unique();
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
            $table->increments('id');
            $table->string('ma_lop')->unique();
            $table->string('ten_lop')->unique();
            $table->string('mo_ta')->nullable($value = true);
            $table->integer('anh_nen_id')->nullable($value = true);
            $table->timestamps();
            $table->softDeletes();
        });

        //Long
        Schema::create('bai_dang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieu_de');
            $table->string('noi_dung');
            $table->datetime('han_nop')->nullable($value = true);
            $table->integer('loai_bai_dang_id');
            $table->integer('lop_hoc_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('binh_luan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bai_dang_id');
            $table->integer('nguoi_dung_id');
            $table->string('noi_dung');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_binh_luan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('binh_luan_id');
            $table->string('dinh_kem');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_bai_dang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bai_dang_id');
            $table->string('dinh_kem');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dinh_kem_bai_nop', function (Blueprint $table) {
            $table->increments('id');
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

        // Schema::dropIfExists('phong_cho_lop_hoc');

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
