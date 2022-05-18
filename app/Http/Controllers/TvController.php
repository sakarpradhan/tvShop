<?php

namespace App\Http\Controllers;

use App\Http\Requests\TVFormRequest;
use App\Models\Tv;
use App\Models\Timer;
use Illuminate\Support\Facades\Storage;

class TvController extends Controller
{
    public function filterTv()
    {
        $CURRENT_TIME = now('+05:45')->toTimeString();
        $CURRENT_DATETIME = now('+05:45')->toDateTimeString();

        $tvToDelete = Timer::whereTime('remove_after', '<', $CURRENT_DATETIME)->pluck('tv_id')->toArray();

        foreach ($tvToDelete as $tv)
        {
            if (Tv::find($tv)->timer()->exists())
            {
                Tv::find($tv)->timer()->delete();
            }
            $this->destroy($tv);
        }

        $tvWithTimer = Timer::whereTime('display_start', '<=', $CURRENT_TIME)
            ->whereTime('display_end', '>=', $CURRENT_TIME)
            ->pluck('tv_id')->toArray();

        $tvWithoutTimer = Tv::whereNotIn('id', Timer::pluck('tv_id'))->pluck('id')->toArray();

        return array_merge($tvWithTimer, $tvWithoutTimer);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view(
            'tvshop\list',
            ['allTv' => Tv::whereIn('id', $this->filterTv())->simplePaginate(5)]
        );
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

    public function edit(Tv $tv)
    {
        return view('tvshop/edit', ['tv' => $tv]);
    }

    public function update(TVFormRequest $request, Tv $tv)
    {
        $attributes = $request->validated();

        if (isset($attributes['path'])) {
            $attributes['path'] = request()->file('path')->store('tv_images');
            $oldImg = Tv::where('id', $tv->id)->first()->path;
            if (Storage::exists($oldImg)) {
                Storage::delete($oldImg);
            }
        }

        $tv->update($attributes);

        return redirect('/');
    }

    public function destroy($tv)
    {
        if (request()->delete_tv_id)
        {
            $tv = request()->delete_tv_id;
        }

        $img = Tv::where('id', $tv)->first()->path;
        if (Storage::exists($img)) Storage::delete($img);

        Tv::where('id', $tv)->delete();

        return redirect('/');
    }

}
