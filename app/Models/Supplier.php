<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['user_id', 'name', 'company_name', 'nid_no', 'mobile', 'address', 'image'];
}
