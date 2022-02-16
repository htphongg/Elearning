<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';

    public function nguoiDung()
    {
        return $this->belongsTo('App\Models\NguoiDung');
    }

    public function baiDang()
    {
        return $this->belongsTo('App\Models\BaiDang');
    }
}
