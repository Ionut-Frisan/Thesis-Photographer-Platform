<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'cover_image_id',
        'owner_id',
        'standard',
        'title',
        'description',
        'address',
        'accessibility',
        'opening_hours',
        'closing_hours',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'cover_image_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected function casts(): array
    {
        return [
            'standard' => 'boolean',
        ];
    }
}
