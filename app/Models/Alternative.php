<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $fillable = [
        'nama_alternatif', 'alamat', 'no_hp',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_alternatif';
}
