<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'categories_id',
        'users_id',
        'image_old', 
        'image_new', 
        'status'
    ];
}
