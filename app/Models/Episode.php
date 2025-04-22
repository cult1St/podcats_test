<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Episode",
 *     description="Episode model",
 *     @OA\Xml(name="Episode")
 * )
 */
class Episode extends Model
{
    use HasFactory;
    public function podcast(): BelongsTo{
        return $this->belongsTo(Podcasts::class, "podcast_id");
    }
}
