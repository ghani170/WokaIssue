<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    //
    protected $table = 'lampirans';

    protected $fillable =[
        'laporan_id',
        'dokumentasi',
    ];
}
