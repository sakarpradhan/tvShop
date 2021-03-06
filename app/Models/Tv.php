<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;

    protected $fillable = [
        'model', 'price', 'path'
    ];

    public function timer()
    {
        return $this->hasOne(Timer::class, 'tv_id');
    }
}
