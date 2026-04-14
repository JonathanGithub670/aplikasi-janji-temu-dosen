<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'kode', 'nama_kriteria', 'atribut', 'bobot',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_kriteria';
}
