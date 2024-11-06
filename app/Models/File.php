<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'storage_provider',
        'path',
        'name',
        'size',
        'mime',
        'extension',
    ];
}
