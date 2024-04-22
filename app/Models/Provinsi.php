<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $primaryKey = 'prov_id';

    protected $fillable = ['prov_name'];

    public function cities()
    {
        return $this->hasMany(Kota::class, 'prov_id', 'prov_id');
    }
}
