<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class KategoriObat extends Model
{
    use HasFactory;

    protected $table = 'kategori_obat';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_klinik',
        'nama',
        'keterangan',
        'status_aktif',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
