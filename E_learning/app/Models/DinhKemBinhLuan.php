<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinhKemBinhLuan extends Model
{
    use HasFactory;
    protected $table = 'dinh_kem_binh_luan';
    public function binhLuan()
    {
        return $this->belongsTo('App\Models\BinhLuan');
    }
}
