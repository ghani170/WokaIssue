<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LampiranDev extends Model
{
    protected $table = 'lampiran_devs';

    protected $fillable =[
        'laporan_id',
        'dokumentasi_developer',
    ];

    public function laporanDev() {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}
