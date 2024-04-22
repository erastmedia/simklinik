<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StraPhoto extends Model
{
    use HasFactory;

    protected $table = 'stra_photos';

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
