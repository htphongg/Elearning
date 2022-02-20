<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';
    public function nguoiViet()
    {
        return $this->belongsTo('App\Models\NguoiDung', 'nguoi_dung_id');
    }
}
