<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PodcastsResource;
use App\Models\Category;
use App\Models\Podcasts;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;



/**
 * @OA\Info(
 *     title="Podcast Platform API",
 *     version="1.0.0",
 *     description="API documentation for the Podcast Platform built with Laravel"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */

class CategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/",
     *     tags={"Index Page"},
     *     summary="Get index page data",
     *     @OA\Response(
     *         response=200,
     *         description="Index page data",
     *         @OA\JsonContent(type="object", @OA\Property(property="featured", type="array", @OA\Items(ref="#/components/schemas/PodcastsResource")), @OA\Property(property="recent", type="array", @OA\Items(ref="#/components/schemas/PodcastsResource")))
     *     )
     * )
     */
    public function index_page(){
        $featured = Podcasts::featured()->take(5)->get();
        $recent = Podcasts::latest()->paginate(10);

        return response()->json( [
            'success' => true,
            'message' => "Landing Page Data Sent Successfully",
            'featured' => PodcastsResource::collection($featured),
            'recent' => PodcastsResource::collection($recent)
        ], 200);
    }



        /**
     * @OA\Get(
     *     path="/api/categories",
     *     tags={"Categories"},
     *     summary="Get all categories",
     *     @OA\Response(
     *         response=200,
     *         description="List of categories",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *     )
     * )
     */


    public function index(){


        return response()->json([
            'success' => true,
            'message' => "Categories Data Sent Successfully",
            'data' => CategoryResource::collection(Category::all())
        ], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/categories/{id}/podcasts",
     *     tags={"Categories"},
     *     summary="Get podcasts by category",
     *     @OA\Parameter(name="id", in="path", required=true, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="List of podcasts in the category",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PodcastsResource"))
     *     )
     * )
     */
    public function podcasts($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
                'data' => null,
            ], 404);
        }
        $podcasts = $category->podcasts()
        ->latest()
        ->paginate(request()->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Podcasts data sent successfully.',
            'data' => PodcastsResource::collection($podcasts)
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     tags={"Categories"},
     *     summary="Get category by ID",
     *     @OA\Parameter(name="id", in="path", required=true, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Category data",
     *         @OA\JsonContent(ref="#/components/schemas/CategoryResource")
     *     )
     * )
     */

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category data retrieved successfully.',
            'data' => new CategoryResource($category),
        ], 200);
    }

}
