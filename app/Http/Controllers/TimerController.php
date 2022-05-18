<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use App\Models\Tv;
use Illuminate\Validation\Rule;

class TimerController extends Controller
{
    public function create()
    {
        return view('tvshop.timer.create', ['allTv' => Tv::all()]);
    }

    public function store()
    {
        $attribute = request()->validate([
            'tv_id' =>  ["required", "numeric", Rule::exists('tvs', 'id')],
            'display_start' =>  ["date_format:H:i"],
            'display_end'   =>  ["date_format:H:i"],
            'remove_after'  =>  ["date"]
        ]);

        // if the record with the said tv_id exists, update; else, create new
        $timer = Timer::updateOrCreate(
            ['tv_id' => $attribute['tv_id']],
            $attribute
        );

        return redirect('/');
    }
}
