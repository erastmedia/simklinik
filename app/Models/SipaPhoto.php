<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SipaPhoto extends Model
{
    use HasFactory;

    protected $table = 'sipa_photos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'path', 
        'klinik_id', 
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
