<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['thumbnail_image_url', 'final_amount'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getThumbnailImageUrlAttribute()
    {
        return env('APP_URL') . 'storage/' . $this->thumbnail_image;
    }

    function getFinalAmountAttribute()
    {
        $final_amount = 0.0;

        // Get carat price using the helper function
        $carat_price = getCaratPrice($this->metal_id, $this->carat_id);

        // Calculate the price based on weight
        $price = $carat_price * $this->weight;

        // Additional charges
        $packing_charge = $this->packing_charge;
        $hallmarking_charge = $this->hallmarking_charge;

        // Calculate making charge as a percentage of the price
        $making_charge = $price * ($this->making_charge / 100);

        // Final amount calculation
        $final_amount = $price + $packing_charge + $hallmarking_charge + $making_charge;

        // Return final amount formatted to 2 decimal places
        return round($final_amount, 2);
    }

}
