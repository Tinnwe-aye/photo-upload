<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_tbl extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'username',
        'password',
        'photo_name',
        'photo_data',
    ];
}
