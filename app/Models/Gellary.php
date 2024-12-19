<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gellary extends Model
{
    protected $fillable = ['user_id', 'title', 'short_discription', 'image', 'location'];
}
