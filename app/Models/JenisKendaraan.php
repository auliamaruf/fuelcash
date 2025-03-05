<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JenisKendaraan extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'desc'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function kendaraanPegawais(): HasMany
    {
        return $this->hasMany(KendaraanPegawai::class, 'id_jenis_kendaraan');
    }
}
