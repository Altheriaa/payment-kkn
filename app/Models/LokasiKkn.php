<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiKkn extends Model
{
    protected $table = 'lokasi_kkn';

    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten_kota'
    ];

    // satu lokasi kkn hanya bisa dihuni oleh satu kelompok (pertimbangan karna bisa milih tahun)
    public function kelompokKkn()
    {
        return $this->hasOne(KelompokKkn::class, 'lokasi_kkn_id');
    }
}
