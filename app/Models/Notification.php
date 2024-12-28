<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['new_date_time'];

    /**
     * Accessor for new_date_time.
     *
     * @return string
     */
    public function getNewDateTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y, h:i A');
    }
}
