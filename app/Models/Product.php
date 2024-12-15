<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['thumbnail_image_url'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getThumbnailImageUrlAttribute()
    {
        return env('APP_URL') . '/storage/' . $this->thumbnail_image;
    }
}
