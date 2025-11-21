<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table= 'laporans';

    protected $fillable =[
        'project_id',
        'client_id',
        'developer_id',
        'title',
        'deskripsi',
        'tipe',
        'prioritas',
        'status',
        'deadline',
    ];
}
