<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $primaryKey = 'id';

    protected $fillable = ['nama_poli', 'deskripsi', 'id_tipe_lokasi_poli'];

    public function tipeLokasiPoli()
    {
        return $this->belongsTo(TipeLokasiPoli::class, 'id_tipe_lokasi_poli', 'id');
    }
}
