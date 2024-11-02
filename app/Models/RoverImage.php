<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoverImage extends Model
{
    protected $fillable = ['sol', 'img_src', 'camera_name', 'earth_date'];
}