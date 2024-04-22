<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = 'diagnosa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kode',
        'id_klinik',
        'nama_en',
        'nama_id',
        'status_aktif',
        'as_head',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
