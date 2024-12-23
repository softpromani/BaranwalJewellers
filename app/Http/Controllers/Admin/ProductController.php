<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carat;
use App\Models\Category;
use App\Models\Metal;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::paginate(10);
       return view('admin.product.list', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metals = Metal::get();
        $carats = Carat::get();
        $categories = Category::get();
        return view('admin.product.add', compact('metals','carats','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'thumbnail_image' => 'required',
            // 'images' => 'nullable',
            'packing_charge' => 'required',
            'hallmarking_charge' => 'required',
            'making_charge' => 'required',
            'stock' => 'required',
            'tax' => 'required',
            'metal_id' => 'required',
            'carat_id' => 'required',
            'weight' => 'required'
        ]);

    //    if ($request->hasFile('images')) {
    //         $file = $request->file('images');
    //         $path = $file->store('products', 'public');
    //     }

        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $thumbnailpath = $file->store('products/thumbnail', 'public');
        }

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'thumbnail_image' => $thumbnailpath,
            // 'images' => $path ?? null,
            'packing_charge' => $request->packing_charge,
            'hallmarking_charge' => $request->hallmarking_charge,
            'making_charge' => $request->making_charge,
            'stock' => $request->stock,
            'tax' => $request->tax,
            'metal_id' => $request->metal_id,
            'carat_id' => $request->carat_id,
            'weight' => $request->weight
        ];

        Product::create($data);
        return redirect()->route('admin.product.index')->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $editproduct = $product;
        $metals = Metal::get();
        $carats = Carat::get();
        $categories = Category::get();
        return view('admin.product.add', compact('editproduct', 'metals','carats','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'thumbnail_image' => 'nullable',
            // 'images' => 'nullable',
            'packing_charge' => 'required',
            'hallmarking_charge' => 'required',
            'making_charge' => 'required',
            'stock' => 'required',
            'tax' => 'required',
            'metal_id' => 'required',
            'carat_id' => 'required',
            'weight' => 'required'
        ]);

        // if ($request->hasFile('images')) {
        //     $file = $request->file('images');
        //     $path = $file->store('products', 'public');
        //     Product::find($product->id)->update(['images' => $path]);
        // }

        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $thumbnailpath = $file->store('products/thumbnail', 'public');
            Product::find($product->id)->update(['thumbnail_image' => $thumbnailpath]);
        }

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            // 'images' => $path ?? null,
            'packing_charge' => $request->packing_charge,
            'hallmarking_charge' => $request->hallmarking_charge,
            'making_charge' => $request->making_charge,
            'stock' => $request->stock,
            'tax' => $request->tax,
            'metal_id' => $request->metal_id,
            'carat_id' => $request->carat_id,
            'weight' => $request->weight
        ];

        $product = $product::find($product->id)->update($data);
        return redirect()->route('admin.product.index')->with('success','Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       $product->delete();
       return redirect()->back()->with('success','Product deleted successfully');
    }
}
