<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $fillable =[
        'laporan_id',
        'user_id',
        'comment'
    ];
}
