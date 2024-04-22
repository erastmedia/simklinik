<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpesialisasiDokter extends Model
{
    use HasFactory;

    protected $table = 'spesialisasi_dokter';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_spesialisasi', 
        // 'id_klinik', 
    ];

    // public function klinik(): BelongsTo
    // {
    //     return $this->belongsTo(Klinik::class);
    // }
}
