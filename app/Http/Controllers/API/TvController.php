<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TVFormRequest;
use App\Models\Tv;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class TvController extends Controller
{
    public function index()
    {
        $tvs = Tv::all();
        foreach ($tvs as $tv) {
            $tv['path'] = asset('storage/' . $tv['path']);
        }
        return response()->json($tvs);
    }

    public function show($tv)
    {
        try {
            $tv = Tv::findOrFail($tv);
            $tv['path'] = asset('storage/' . $tv['path']);
            return response()->json($tv);
        } catch (ModelNotFoundException $error) {
            return response([
                'status' => '404',
                'error' => 'Record not found.'
            ], 404);
        }
    }

    public function store(TVFormRequest $request)
    {
        // exception handling not required,
        //header->accept->application/json, required in request_body
//        try {
            $attributes = $request->validated();
//        } catch (ValidationException $e) {
//            return response([
//                'status'    => '422',
//                'error'     => 'Validation error',
//                'specific'  => $e
//            ], 422);
//        }

        $attributes['path'] = request()->file('path')->store('tv_images');

        $tv = Tv::create($attributes);

        return response()->json($tv);
    }

    public function update(TVFormRequest $request, $tv)
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

        return response()->json($tv);
    }

    public function destroy($tv)
    {
        $img = Tv::where('id', $tv)->first()->path;
        if (Storage::exists($img)) Storage::delete($img);

        Tv::where('id', $tv)->delete();
        return response()->json(['message' => 'TV removed from database.'], 204);
    }
}
