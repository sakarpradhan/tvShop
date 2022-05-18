<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;

    protected $table = 'tvs_timer';

    protected $fillable = [
        'tv_id', 'display_start', 'display_end', 'remove_after'
    ];
}
