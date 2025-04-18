<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_location extends Model
{
    public $table = "user_location";
    protected $fillable = ['userId','city','country'];
    public $timestamps = false;
}
