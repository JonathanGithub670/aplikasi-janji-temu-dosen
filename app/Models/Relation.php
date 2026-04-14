<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = [
        'alternatif', 'kriteria', 'nilai',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_relasi';
}
