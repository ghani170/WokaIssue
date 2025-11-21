<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';

    protected $fillable =[
        'name',
        'alamat',
        'telepon',
    ];

    public function user() {
        return $this->hasOne(User::class, 'company_id');
    }

    public function project() {
        return $this->hasMany(Project::class, 'company_id');
    }
}
