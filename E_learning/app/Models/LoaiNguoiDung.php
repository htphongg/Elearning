<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiNguoiDung extends Model
{
    use HasFactory;
    protected $table = 'loai_nguoi_dung';

    public function dsNguoiDung()
    {
        return $this->hasMany('App\Models\NguoiDung');
    }
}
