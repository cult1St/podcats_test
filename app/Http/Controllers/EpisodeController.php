<?php

namespace App\Http\Controllers;

use App\Http\Resources\EpisodeResource;
use App\Models\Episode;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class EpisodeController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/episodes",
     *     summary="Get all episodes",
     *     tags={"Episodes"},
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
    public function index(){


        return response()->json([
            'success' => true,
            'message' => "Episodes Data Sent Successfully",
            'data' => EpisodeResource::collection(Episode::latest()->paginate(10))
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/episodes/{id}",
     *     summary="Get episode by ID",
     *     tags={"Episodes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the episode",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Episode retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", ref="#/components/schemas/EpisodeResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Episode not found"
     *     )
     * )
     */
    public function show($id)
    {
        $episode = Episode::find($id);

        if (!$episode) {
            return response()->json([
                'success' => false,
                'message' => 'Episode not found.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Episode data retrieved successfully.',
            'data' => new EpisodeResource($episode),
        ], 200);
    }
}
