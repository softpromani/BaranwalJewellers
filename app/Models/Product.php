<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['thumbnail_image_url', 'final_amount', 'price_breakdown'];

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

        //tax charge
        $tax_charge = $price * ($this->tax / 100);

        // Final amount calculation
        $final_amount = $price + $packing_charge + $hallmarking_charge + $making_charge + $tax_charge;

        // Return final amount formatted to 2 decimal places
        return round($final_amount, 2);
    }

    function getPriceBreakdownAttribute()
    {
        $final_amount = 0.0;

        // Get carat price using the helper function
        $carat_price = getCaratPrice($this->metal_id, $this->carat_id);

        // Calculate the price based on weight
        $price = round($carat_price * $this->weight, 2);

        // Additional charges
        $packing_charge = $this->packing_charge;
        $hallmarking_charge = $this->hallmarking_charge;

        // Calculate making charge as a percentage of the price
        $making_charge = round($price * ($this->making_charge / 100), 2);

        //tax charge
        $tax_charge = round($price * ($this->tax / 100), 2);

        // Final amount calculation
        $final_amount = $price + $packing_charge + $hallmarking_charge + $making_charge + $tax_charge;

        return $data = [
            'price' => $this->weight .'gms / '.$price,
            'packing_charge' => $packing_charge,
            'hallmarking_charge' => $hallmarking_charge,
            'making_charge' => $this->making_charge .'% / '. $making_charge,
            'tax' => $this->tax .'% / '.$tax_charge,
            'final_amount' => round($final_amount, 2),
        ];
    }

}
