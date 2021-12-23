<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    protected $table = 'lop_hoc';

    public function dsNguoiDung()
    {
        return $this->belongsToMany('App\Models\NguoiDung','chi_tiet_lop_hoc');
    }
}
