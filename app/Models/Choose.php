<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Choose extends Model
{
    
    protected $primaryKey = "id";
    protected $guarded    = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function create()
    {
        return $this->hasOne(User::class, 'id', 'create_user_id', 'status');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class, 'id', 'create_user_id');
    }
    
}
