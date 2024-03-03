<?php

namespace App\Http\Controllers\Api;

use App\Models\Anime;
use Illuminate\Http\Request;
use App\Http\Requests\AnimeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnimeRequest;
use App\Http\Resources\AnimeResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        $anime = Anime::create($validated);

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
}
