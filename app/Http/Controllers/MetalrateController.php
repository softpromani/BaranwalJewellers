<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use App\Models\Carat;
use App\Models\Metal;
use App\Models\MetalCaratRate;
use Illuminate\Http\Request;

class MetalrateController extends Controller
{

    public function metal_rate()
    {
        $metals = Metal::get();
        $carats = Carat::get();
        $metal_carat_rate = MetalCaratRate::get();
        return view('admin.business-setting.metal-rate', compact('metals', 'carats','metal_carat_rate'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'metal_id' => 'required|array',
            'carat_id' => 'required|array',
            'price' => 'required|array',
        ]);

        // Loop through the arrays and save/update records
        $metalIds = $request->input('metal_id');
        $caratIds = $request->input('carat_id');
        $prices = $request->input('price');
        //   dd($prices);
        foreach ($metalIds as $key => $metalId) {
            // Skip if price is null
            if (is_null($prices[$key])) {
                continue;
            }

            // Update or Create the record
            MetalCaratRate::updateOrCreate(
                [
                    'metal_id' => $metalId,
                    'carat_id' => $caratIds[$key],
                ],
                [
                    'price' => $prices[$key],
                ]
            );
        }
        return redirect()->back()->with('success', 'Metal Rate Updated Successfully.');

    }

    public function liveRateSetup()
    {
        return view('admin.business-setting.live-rate-setup');
    }

    public function updateLiveRate(Request $request)
    {
        if($request->silver_jewellery){
            BusinessSetting::updateOrCreate(['key'=>'silver_jewellery'],['value'=>$request->silver_jewellery]);
        }
        if($request->gold_jewellery_99){
            BusinessSetting::updateOrCreate(['key'=>'gold_jewellery_99'],['value'=>$request->gold_jewellery_99]);
        }
        if($request->gold_jewellery_24k){
            BusinessSetting::updateOrCreate(['key'=>'gold_jewellery_24k'],['value'=>$request->gold_jewellery_24k]);
        }
        if($request->gold_jewellery_22k){
            BusinessSetting::updateOrCreate(['key'=>'gold_jewellery_22k'],['value'=>$request->gold_jewellery_22k]);
        }
        if($request->gold_jewellery_18k){
            BusinessSetting::updateOrCreate(['key'=>'gold_jewellery_18k'],['value'=>$request->gold_jewellery_18k]);
        }
        if($request->gold_costing){
            BusinessSetting::updateOrCreate(['key'=>'gold_costing'],['value'=>$request->gold_costing]);
        }
        if($request->silver_costing){
            BusinessSetting::updateOrCreate(['key'=>'silver_costing'],['value'=>$request->silver_costing]);
        }

        return redirect()->back()->with('success', 'Live Rate Updated Successfully.');

    }
}
