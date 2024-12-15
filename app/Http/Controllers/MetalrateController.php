<?php

namespace App\Http\Controllers;

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
}
