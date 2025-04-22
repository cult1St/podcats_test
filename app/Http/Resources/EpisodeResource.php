<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Episode Resource",
 *     description="Episode Resource model",
 *     @OA\Xml(name="EpisodeResource")
 * )
 */

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);

       return [
            'id' => $this->id,
            'title' => $this->title,
            'audio_url' => $this->audio_url,
            'duration' => $this->duration,
            'podcast' => new PodcastsResource($this->whenLoaded('podcast')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
