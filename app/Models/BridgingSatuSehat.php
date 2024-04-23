<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BridgingSatuSehat extends Model
{
    use HasFactory;

    protected $table = 'bridging_satu_sehat';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_klinik',
        'organization_id',
        'client_key',
        'secret_key',
    ];

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
