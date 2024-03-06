<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $image = $this->image ? asset('/storage/' . $this->image) : null;
        
        return [
            'title' => $this->title,
            'description' => $this->description,
            'episode' => $this->episode,
            'image' => $image,
            'genre' => GenreResource::collection($this->genres)
        ];
    }
}
