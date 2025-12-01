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

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function developer() {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function lampiran() {
        return $this->hasMany(Lampiran::class, 'laporan_id');
    }

    public function lampiranDev() {
        return $this->hasMany(LampiranDev::class, 'laporan_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'laporan_id');
    }
}
