<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingDetail extends Model
{
    protected $fillable = ['user_id', 'name', 'title', 'discription', 'location', 'total_land', 'no_of_storied', 'total_owner', 'map_location', 'image'];
}
