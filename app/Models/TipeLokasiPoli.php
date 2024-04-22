<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeLokasiPoli extends Model
{
    use HasFactory;

    protected $table = 'tipe_lokasi_poli';

    protected $primaryKey = 'id';

    protected $fillable = ['nama_tipe', 'id_klinik'];

    public function polies()
    {
        return $this->hasMany(Poli::class, 'id_tipe_lokasi_poli', 'id');
    }
}
