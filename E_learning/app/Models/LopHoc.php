<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class LopHoc extends Model
{
    use Notifiable,
        SoftDeletes;
    
    use HasFactory;
    protected $table = 'lop_hoc';

    public function dsNguoiDung()
    {
        return $this->belongsToMany('App\Models\NguoiDung','chi_tiet_lop_hoc')->withPivot('lop_hoc_id','nguoi_dung_id','trang_thai','cach_tham_gia');
    }

    public function dsBaiDang()
    {
        return $this->hasMany('App\Models\BaiDang');
    }
}
