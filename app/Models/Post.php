<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'title',
        'user_id',
        'hit',
        'maincategory_id',
        'subcategory_id',
        'comment',
        'notice',
        'mainimg',
        'commentnum',
        'code',
        'writer',
    ];

    public function getComment(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }
}
