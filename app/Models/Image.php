<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use App\Models\User;

class Image extends Model
{
    protected $fillable = [
        'morphable_id',
        'morphable_type',
        'image_path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
