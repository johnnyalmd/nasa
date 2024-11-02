<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoverInfo extends Model
{
    protected $table = 'rover_info';
    protected $fillable = ['rover_name', 'max_sol', 'max_date', 'status', 'total_photos'];
}
