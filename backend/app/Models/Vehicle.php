<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['external_id','brand','model','version','mileage','fuel','price','photo_url'];
}
