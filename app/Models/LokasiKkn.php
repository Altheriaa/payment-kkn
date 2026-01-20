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

    // satu lokasi kkn bisa dihuni oleh bnyak kelompok (pertimbangan karna bisa milih tahun)
    public function kelompokKkn()
    {
        return $this->hasMany(KelompokKkn::class, 'lokasi_kkn_id');
    }
}
