<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenDpl extends Model
{
    protected $table = 'dosen_dpl';

    protected $fillable = [
        'nuptk',
        'nama_dosen',
        'bidang_keahlian',
        'no_hp'
    ];
}
