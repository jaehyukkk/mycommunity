<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_content',  
        'comment_photo',  
        'comment_writer',  
        'post_id',  
        'user_id',  
        'secretcode',  
        'replycode',  
    ];

   
}
