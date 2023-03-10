<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bbs extends Model
{
    use HasFactory;
    protected $table = "bbs";
    protected $fillable = ["id", 'comment', 'user_id', 'created_at', 'updated_at'];
}
