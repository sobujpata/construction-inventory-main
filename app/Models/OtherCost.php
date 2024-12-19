<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCost extends Model
{
    protected $fillable = ['user_id', 'recipient', 'sector', 'amount', 'remarks'];
}
