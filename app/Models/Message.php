<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'mobile', 'email', 'discription', 'replier_id', 'reply_discription', 'remarks'];
}
