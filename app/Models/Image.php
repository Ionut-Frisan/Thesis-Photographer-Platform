<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photoshoot_id',
        'path',
        'name',
        'size',
        'mime',
        'extension',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function photoshoot()
    {
        return $this->belongsTo(Photoshoot::class);
    }
}
