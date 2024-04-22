<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';

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
        'status_aktif',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
