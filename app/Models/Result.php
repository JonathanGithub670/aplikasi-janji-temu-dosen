<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'alternatif', 'hasil',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_result';
}
