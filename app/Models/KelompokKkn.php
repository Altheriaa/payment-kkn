<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokKkn extends Model
{
    protected $table = 'kelompok_kkn';

    protected $fillable = [
        'jadwal_kkn_id',
        'dpl_id',
        'lokasi_kkn_id',
        'nama_kelompok',
        'jenis_kkn',
    ];

    // satu jadwal kkn punya bnyak kelompok kkn
    public function jadwalKkn()
    {
        return $this->belongsTo(JadwalKkn::class, 'jadwal_kkn_id');
    }

    // satu dpl bisa membimbing bnyak kelompok kkn (pertimbangan karna bisa milih tahun)
    public function dosenDpl()
    {
        return $this->belongsTo(DosenDpl::class, 'dpl_id');
    }

    // satu lokasi kkn bisa dihuni oleh bnyak kelompok (pertimbangan karna bisa milih tahun)
    public function lokasiKkn()
    {
        return $this->belongsTo(LokasiKkn::class, 'lokasi_kkn_id');
    }

    public function pendaftaranKkn()
    {
        return $this->hasMany(PendaftaranKkn::class, 'kelompok_kkn_id');
    }
}
