<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    use HasFactory;
    protected $table = 'nguoi_dung';

    public function loaiNguoiDung()
    {
        return $this->belongsTo('App\Models\LoaiNguoiDung');
    }
}
