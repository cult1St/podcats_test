<?php

namespace App\Http\Controllers;

use App\Http\Resources\EpisodeResource;
use App\Http\Resources\PodcastsResource;
use App\Models\Podcasts;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PodcastsController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/podcasts",
     *     summary="Get all podcasts",
     *     tags={"Podcasts"},
     *     @OA\Response(
     *         response=200,
     *         description="Podcasts retrieved successfully"
     *     ),
     * )
     */
    public function index(){
        return response()->json([
            'success' => true,
            'message' => "Podcasts Data Sent Successfully",
            'data' => PodcastsResource::collection(Podcasts::latest()->paginate(10))
        ], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/podcasts/{id}",
     *     summary="Get podcast by ID",
     *     tags={"Podcasts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the podcast",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Podcast retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", ref="#/components/schemas/PodcastsResource")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $podcast = Podcasts::find($id);

        if (!$podcast) {
            return response()->json([
                'success' => false,
                'message' => 'Podcasts not found.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Podcasts data retrieved successfully.',
            'data' => new PodcastsResource($podcast),
        ], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/podcasts/{id}/episodes",
     *     summary="Get episodes by podcast ID",
     *     tags={"Podcasts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the podcast",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Episodes retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/EpisodeResource"))
     *         )
     *     )
     * )
     */

    public function episodes($id)
    {
        $podcast = Podcasts::find($id);

        if (!$podcast) {
            return response()->json([
                'success' => false,
                'message' => 'Podcast not found.',
                'data' => null,
            ], 404);
        }
        $episodes = $podcast->episodes()
        ->latest()
        ->paginate(request()->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Episodes data sent successfully.',
            'data' => EpisodeResource::collection($episodes)
        ], 200);
    }
}
