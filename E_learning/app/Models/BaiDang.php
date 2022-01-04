<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiDang extends Model
{
    use HasFactory;
    use Notifiable,SoftDeletes;
    protected $table = 'bai_dang';

    public function loaiBaiDang()
    {
        return $this->belongsTo('App\Models\LoaiBaiDang');
    }

    public function lopHoc()
    {
        return $this->belongsTo('App\Models\LopHoc');
    }

    public function dsDinhKem()
    {
        return $this->hasMany('App\Models\DinhKemBaiDang');
    }
}

