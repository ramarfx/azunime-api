<?php

namespace App\Http\Controllers\Api;

use App\Models\Anime;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\AnimeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimeResource;
use App\Http\Requests\UpdateAnimeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anime = Anime::with('genres')->get();
        return AnimeResource::collection($anime);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnimeRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->storePublicly('images', 'public');
            $validated['image'] = $image;
        }

        $genres = Genre::whereIn('name', $request->input('genres'))->pluck('id');
        $anime = Anime::create($validated);

        if ($genres->isNotEmpty()) {
            $anime->genres()->sync($genres);
        }

        return response()->json(new AnimeResource($anime), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        return new AnimeResource($anime);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimeRequest $request, Anime $anime)
    {
        $validated = $request->validated();

        $anime->update($validated);

        return new AnimeResource($anime);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {
        $anime->delete();

        return response()->json(null, 204);
    }

    public function getImage()
    {
        $image = Storage::disk('public')->get('images/1.jpg');
        return response($image, 200)->header('Content-Type', 'image/jpg');
    }
}
