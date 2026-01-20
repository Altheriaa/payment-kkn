<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenDpl extends Model
{
    protected $table = 'dosen_dpl';

    protected $fillable = [
        'nuptk',
        'nama_dosen',
        'prodi',
        'bidang_keahlian',
        'no_hp'
    ];

    // satu dpl bisa membimbing bnyak kelompok (pertimbangan karna bisa milih tahun)
    public function kelompokKkn()
    {
        return $this->hasMany(KelompokKkn::class, 'dpl_id');
    }
}
