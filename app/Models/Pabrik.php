<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Pabrik extends Model
{
    use HasFactory;

    protected $table = 'pabrik';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kode', 
        'id_klinik',
        'nama',
        'alamat',
        'kota',
        'telepon',
        'no_hp',
        'email',
        'rekening',
        'npwp',
        'status_aktif',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
