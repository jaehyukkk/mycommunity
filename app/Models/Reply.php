<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply_content',  
        'reply_photo',  
        'reply_writer',  
        'comment_id',  
        'user_id',  
        'secretcode',  
    ];
}
