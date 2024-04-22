<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SatuanObat extends Model
{
    use HasFactory;

    protected $table = 'satuan_obat';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_klinik',
        'nama',
        'status_aktif',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
