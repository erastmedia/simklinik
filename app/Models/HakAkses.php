<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses';

    protected $primaryKey = 'id';

    protected $fillable = ['hak_akses'];

    // public function polies()
    // {
    //     return $this->hasMany(Poli::class, 'id_tipe_lokasi_poli', 'id');
    // }
}
