<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image_id',
        'title',
        'description',
    ];

    protected $with = [
        'coverImage'
    ];

    public function coverImage(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'cover_image_id');
    }
}
