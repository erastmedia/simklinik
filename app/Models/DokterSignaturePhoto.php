<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DokterSignaturePhoto extends Model
{
    use HasFactory;

    protected $table = 'dokter_signature_photos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'path', 
        'dokter_id', 
    ];

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}
