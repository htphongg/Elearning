<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class DinhKemBaiDang extends Model
{
    use HasFactory;
    use Notifiable,SoftDeletes;

    protected $table = 'dinh_kem_bai_dang';
    protected $fillable = ['dinh_kem'];
    
    public function baiDang()
    {
        return $this->belongsTo('App\Models\BaiDang');
    }
}
