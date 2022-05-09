<?php

namespace App\Http\Controllers;

use App\Http\Requests\TVFormRequest;
use App\Models\Tv;
use Illuminate\Support\Facades\Storage;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('tvshop\list', ['allTv' => Tv::latest()->simplePaginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('tvshop/create');
    }

    public function store(TVFormRequest $request)
    {
        // Validation done by TVFormRequest Class
        // Retrieve the validated input data...
        $attributes = $request->validated();

        $attributes['path'] = request()->file('path')->store('tv_images');

        session()->flash('success', "New TV, {$attributes['model']}, added to the Shop.");

        Tv::create($attributes);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Tv $tv)
    {
        //
    }

    public function edit(Tv $tv)
    {
        return view('tvshop/edit', ['tv' => $tv]);
    }
    public function update(TVFormRequest $request, Tv $tv)
    {
        $attributes = $request->validated();

        if(isset($attributes['path']))
        {
            $attributes['path'] = request()->file('path')->store('tv_images');
            $oldImg = Tv::where('id', $tv->id)->first()->path;
            if(Storage::exists($oldImg))
            {
                Storage::delete($oldImg);
            }
        }

        $tv->update($attributes);

        return redirect('/');
    }

    public function destroy(Tv $tv)
    {
        $img = Tv::where('id', request()->delete_tv_id)->first()->path;
        if (Storage::exists($img)) Storage::delete($img);

        Tv::where('id', request()->delete_tv_id)->delete();
        return redirect('/');
    }
}
