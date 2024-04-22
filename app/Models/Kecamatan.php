<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primaryKey = 'dis_id';

    protected $fillable = ['dis_name', 'city_id'];

    public function city()
    {
        return $this->belongsTo(Kota::class, 'city_id', 'city_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(Kelurahan::class, 'dis_id', 'dis_id');
    }
}
