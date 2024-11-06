<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image_id',
        'title',
        'description',
    ];

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'cover_image_id');
    }
}
