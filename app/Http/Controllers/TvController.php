<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tvshop\list', ['allTv' => Tv::latest()->simplePaginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tvshop/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'model' => 'required',
            'price' => 'required|numeric',
            'path' => 'required|image'
        ]);

        $attributes['path'] = request()->file('path')->store('tv_images');

        session()->flash('success', "New TV, {$attributes['model']}, added to the Shop.");

        Tv::create($attributes);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tv $tv
     * @return \Illuminate\Http\Response
     */
    public function show(Tv $tv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tv $tv
     * @return \Illuminate\Http\Response
     */
    public function edit(Tv $tv)
    {
        return view('tvshop/edit', ['tv' => $tv]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tv $tv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tv $tv)
    {
        $attributes = request()->validate([
            'model' => 'required',
            'price' => 'required|numeric',
            'path' => 'image'
        ]);

        if(isset($attributes['path']))
        {
            $attributes['path'] = request()->file('path')->store('tv_images');
            $oldImg = Tv::where('id', $tv->id)->first()->path;
            if(Storage::exists($oldImg)) {
                Storage::delete($oldImg);
            }
        }

        $tv->update($attributes);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tv $tv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tv $tv)
    {
        $img = Tv::where('id', request()->delete_tv_id)->first()->path;
        if (Storage::exists($img)) Storage::delete($img);

        Tv::where('id', request()->delete_tv_id)->delete();
        return redirect('/');
    }
}
