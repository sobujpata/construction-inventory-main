<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['user_id', 'name', 'father_name', 'mother_name', 'mobile', 'email', 'address', 'image'];
}
