<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="user";
    protected $fillable=["username"];
    public $timestamps = false;
}
