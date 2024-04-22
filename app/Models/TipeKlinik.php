<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKlinik extends Model
{
    use HasFactory;

    protected $table = 'tipe_klinik';

    protected $primaryKey = 'id';

    protected $fillable = ['nama_tipe'];

    // public function kliniks()
    // {
    //     return $this->hasMany(Klinik::class, 'id_tipe', 'id');
    // }
}
