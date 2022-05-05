<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;

//    protected $model;
//    protected $price;
//    protected $path;

    protected $fillable = [
        'model', 'price', 'path'
    ];
}
