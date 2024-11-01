<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoshootOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'photographer_id',
        'title',
        'description',
        'duration',
        'price',
        'max_images_count',
        'avg_turnaround_time',
        'delivery_method',
        'cancellation_policy',
    ];

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
}
