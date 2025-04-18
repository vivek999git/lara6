<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    public $table = "user_detail";
    protected $fillable = ['userId','gender'];
    public $timestamps = false;
}
