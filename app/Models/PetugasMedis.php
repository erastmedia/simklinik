<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PetugasMedis extends Model
{
    use HasFactory;

    protected $table = 'petugas_medis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nik', 
        'id_satu_sehat',
        'nama',
        'id_bagian',
        'alamat',
        'kota',
        'telepon',
        'username',
        'tgl_masuk',
        'status_aktif',
        'email',
        'path_foto'
    ];

    public function bagianSpesialisasi(): BelongsTo
    {
        return $this->belongsTo(BagianSpesialisasi::class);
    }
}
