<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//landing page
Route::get("/", [CategoryController::class, "index_page"]);


//Categories
Route::prefix("categories")->group(function(){
    Route::get("/", [CategoryController::class, "index"]);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::get('/{id}/podcasts', [CategoryController::class, 'podcasts']);
});

//Podcasts
Route::prefix("podcasts")->group( function(){
    Route::get("/", [PodcastsController::class, "index"]);
    Route::get('/{id}', [PodcastsController::class, 'show']);
    Route::get('/{id}/episodes', [PodcastsController::class, 'episodes']);
});

//Episodes
Route::prefix( "episodes")->group( function(){
    Route::get("/", [EpisodeController::class, "index"]);
    Route::get('/{id}', [EpisodeController::class, 'show']);
});
