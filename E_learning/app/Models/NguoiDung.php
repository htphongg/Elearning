<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'nguoi_dung';

    public function loaiNguoiDung()
    {
        return $this->belongsTo('App\Models\LoaiNguoiDung');
    }

    public function dsLopHoc()
    {
        return $this->belongsToMany('App\Models\LopHoc', 'chi_tiet_lop_hoc')->withPivot('lop_hoc_id', 'nguoi_dung_id', 'trang_thai', 'cach_tham_gia');
        //chi_tiet_lop_hoc.lop_hoc_id = lop_hoc.id AND
        //chi_tiet_lop_hoc.nguoi_dung_id = nguoi_dung.id
    }
    public function dsBinhLuan()
    {
        return $this->hasMany('App\Models\BinhLuan');
    }
}
