<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    protected $appends = ['image_url'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getImageUrlAttribute()
    {
        return env('APP_URL') . '/storage/' . $this->image;
    }
}
