<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LoaiBaiDang extends Model
{
    use HasFactory;
    protected $table = 'loai_bai_dang';

    public function dsBaiDang()
    {
        return $this->hasMany('App\Models\BaiDang');
    }
}
