<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DinhKemBaiDang extends Model
{
    use HasFactory;
    protected $table = 'dinh_kem_bai_dang';
    protected $fillable = ['dinh_kem'];
    public function baiDang()
    {
        return $this->belongsTo('App\Models\BaiDang');
    }
}
