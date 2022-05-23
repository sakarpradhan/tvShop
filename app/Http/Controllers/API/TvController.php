<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TVFormRequest;
use App\Models\Tv;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TvResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TvController extends Controller
{
    public function index()
    {
        try {
            $data = TvResource::collection(Tv::all());
            $response = [
                'status'    => 200,
                'message'   => 'Records found.',
                'data'      => $data
            ];
        }
        catch (\Exception $error)
        {
            $response = [
                'status'    => 204,
                'message'   => $error->getMessage(),
                'data'      => []
            ];
        }

        return response()->json($response);

    }

    public function show($tv)
    {
        try {
            $response = [
                'status'    =>  200,
                'message'   =>  'Record found.',
                'data'      =>  new TvResource(Tv::findOrFail($tv))
            ];
        } catch (ModelNotFoundException $error) {
            $response = [
                'status'    => 204,
                'message'   => 'Record not found.',
                'data'      => []
            ];

        }
        return response()->json($response); // adding status 204 returns empty json
    }

    public function store(TVFormRequest $request)
    {
//         exception handling not required,
//        header->accept->application/json, required in request_body
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
