<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    use HasFactory;

    protected $table = 'jaminan';

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
