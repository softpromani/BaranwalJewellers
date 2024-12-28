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
  protected $append = ['new_date_time'];

  function getNewDateTimeAttribute()
  {
    return Carbon::parse($this->created_at)->format('d M Y, HH:ii');
  }
}
