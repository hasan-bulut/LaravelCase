<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpModel extends Model
{
    use HasFactory;

    protected $table = "logs";
    protected $fillable = ["ip", "request_counter", "time_to_delete_request", "banned"];
    public $timestamps = false;
}
