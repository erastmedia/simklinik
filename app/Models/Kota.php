<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $primaryKey = 'city_id';

    protected $fillable = ['city_name', 'prov_id'];

    public function province()
    {
        return $this->belongsTo(Provinsi::class, 'prov_id', 'prov_id');
    }

    public function districts()
    {
        return $this->hasMany(Kecamatan::class, 'city_id', 'city_id');
    }
}
