<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KendaraanPegawai extends Model
{
    use HasUuids;

    protected $fillable = [
        'id_jenis_kendaraan',
        'nama_pemilik',
        'plat_nomor',
    ];

    public function jenisKendaraan(): BelongsTo
    {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_kendaraan');
    }
}
