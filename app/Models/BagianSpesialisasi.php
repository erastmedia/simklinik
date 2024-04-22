<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BagianSpesialisasi extends Model
{
    use HasFactory;

    protected $table = 'bagian_spesialisasi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_bagian', 
        'id_klinik', 
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
