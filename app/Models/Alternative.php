<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $table = 'alternatif';
    protected $fillable = [
        'kode_alternatif', 'nama_alternatif',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_alternatif';
}
