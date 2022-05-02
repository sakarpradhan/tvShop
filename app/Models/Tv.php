<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;

    protected $model;
    protected $price;
    protected $path;

    protected $fillable = [
        'model', 'price', 'path'
    ];

    // public function __construct($model, $price, $path)
    // {
    //     $this->model = $model;
    //     $this->price = $price;
    //     $this->path = $path;
    // }
}
