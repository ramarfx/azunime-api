<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\AnimeResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::all();

        return response()->json($genre);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $validated = $request->validated();
        
        $genre = Genre::create($validated);

        return response()->json($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Genre $genres)
    {
        $genre = $genres->where('name', $request->genre)->first();
        $anime = $genre->animes()->get();

        return AnimeResource::collection($anime);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $request = $request->validated();

        $genre->update($request);

        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json($genre);
    }
}
