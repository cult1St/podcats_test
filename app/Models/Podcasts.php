<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     title="Podcasts",
 *     description="Podcasts model",
 *     @OA\Xml(name="Podcasts")
 * )
 */

class Podcasts extends Model
{
    use HasFactory;

    // app/Models/Podcast.php

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function episodes(): HasMany{
        return $this->hasMany(Episode::class, "podcast_id");
    }
}
