<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
    protected $guarded = [];
    protected $appends = ['image_url'];


    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('is_admin', 0);
    }

    function getNameAttrribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getImageUrlAttribute()
    {
        return env('APP_URL') . 'storage/' . $this->image;
    }
}
