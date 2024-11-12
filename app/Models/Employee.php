<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id','name', 'detailed_for', 'nid_no', 'mobile_no', 'address', 'image'];
}
