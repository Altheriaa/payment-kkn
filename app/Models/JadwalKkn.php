<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKkn extends Model
{
    protected $table = 'jadwal_kkn';

    protected $fillable = [
        'id_siakad',
        'tahun_akademik_id',
        'nama_periode',
        'semester',
        'tahun_ajaran',
        'tanggal_dibuka',
        'tanggal_ditutup',
        'is_active',
    ];

    public function kelompokKkn()
    {
        return $this->hasMany(KelompokKkn::class, 'jadwal_kkn_id');
    }

    public function pendaftaranKkn()
    {
        return $this->hasMany(PendaftaranKkn::class, 'jadwal_kkn_id');
    }
}
