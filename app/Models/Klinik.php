<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klinik extends Model
{
    use HasFactory;

    protected $table = 'klinik';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_klinik', 
        'nama_pemilik', 
        'penanggung_jawab', 
        'penanggung_jawab_lab', 
        'id_tipe', 
        'prov_id', 
        'city_id', 
        'dis_id', 
        'subdis_id', 
        'kode_pos', 
        'rt', 
        'rw', 
        'telepon', 
        'email', 
        'alamat', 
        'latitude', 
        'longitude', 
        'website', 
        'npwp', 
        'no_register', 
        'tgl_berlaku_register', 
        'nama_apj', 
        'no_stra', 
        'tgl_berlaku_stra', 
        'no_sipa', 
        'tgl_berlaku_sipa', 
        'file_logo', 
    ];

    public function regfiles(): HasMany
    {
        return $this->hasMany(RegisterPhoto::class);
    }

    public function strafiles(): HasMany
    {
        return $this->hasMany(StraPhoto::class);
    }

    public function sipafiles(): HasMany
    {
        return $this->hasMany(SipaPhoto::class);
    }

    public function logofiles(): HasMany
    {
        return $this->hasMany(LogoPhoto::class);
    }

    public function spesialisasiDokters(): HasMany
    {
        return $this->hasMany(SpesialisasiDokter::class);
    }
}
