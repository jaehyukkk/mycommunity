<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maincategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'maincategoryname',  
    ];
}
