<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'company_id',
        'nama_project',
        'deskripsi',
        'status',
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function laporan() {
        return $this->hasMany(Laporan::class, 'project_id');
    }

    public function client() {
        return $this->belongsTo(Laporan::class, 'client_id');
    }
    public function developer() {
        return $this->belongsTo(Laporan::class, 'developer_id');
    }
}
