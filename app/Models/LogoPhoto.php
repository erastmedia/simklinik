<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoPhoto extends Model
{
    use HasFactory;

    protected $table = 'logo_photos';

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
