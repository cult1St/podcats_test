<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category model",
 *     @OA\Xml(name="Category")
 * )
 */
class Category extends Model
{

    use HasFactory;

    public function podcasts(): HasMany{
        return $this->hasMany(Podcasts::class);
    }
}
