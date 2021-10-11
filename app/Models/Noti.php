<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
    use HasFactory;

    protected $fillable = [
        'noti_content',
        'user_id',
        'post_id',
        'noti_code',
    ];
}
