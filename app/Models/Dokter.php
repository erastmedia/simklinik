<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nik', 
        'id_satu_sehat',
        'nama',
        'id_spesialis',
        'id_klinik',
        'alamat',
        'kota',
        'telepon',
        'no_str',
        'username',
        'tgl_masuk',
        'status_aktif',
        'email',
        'path_foto',
        'path_tdt',
        'path_stamp'
    ];

    public function spesialisasiDokter(): BelongsTo
    {
        return $this->belongsTo(SpesialisasiDokter::class);
    }

    public function photoFiles(): HasMany
    {
        return $this->hasMany(DokterPhoto::class);
    }

    public function signatureFiles(): HasMany
    {
        return $this->hasMany(DokterSignaturePhoto::class);
    }

    public function stampFiles(): HasMany
    {
        return $this->hasMany(DokterStampPhoto::class);
    }
}
