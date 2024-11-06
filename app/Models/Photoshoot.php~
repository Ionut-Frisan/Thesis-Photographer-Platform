<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photoshoot extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'photographer_id',
        'status',
        'start_time',
        'end_time',
        'location',
        'description',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
