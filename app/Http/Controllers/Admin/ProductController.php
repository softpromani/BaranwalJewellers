<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::all();
       return view('admin.product.list', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if ($request->hasFile('images')) {
    $file = $request->file('images');
    $path = $file->store('products', 'public');

}

if ($request->hasFile('thumbnail_image')) {
    $file = $request->file('thumbnail_image');
    $thumbnailpath = $file->store('products', 'public');
}


$data = [

    'name' => $request->name,
    'description' => $request->description,
    'thumbnail_image' => $thumbnailpath,
    'images' => $path ?? null,

];

Product::create($data);
return redirect()->route('admin.product.index');

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
        $products = Product::all();
        return view('admin.product.add', compact('editproduct', 'products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
    if ($request->hasFile('images')) {
    $file = $request->file('images');
    $path = $file->store('products', 'public');
    Product::find($product->id)->update(['images' => $path]);
}


    if ($request->hasFile('thumbnail_image')) {
    $file = $request->file('thumbnail_image');
    $path = $file->store('products', 'public');
    Product::find($product->id)->update(['thumbnail_image' => $path]);
    }

$data = [

    'name' => $request->name,
    'description' => $request->description,


];

$product = $product::find($product->id)->update($data);
return redirect()->route('admin.product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       $product->delete();
       return redirect()->route('admin.product.index');

    }
}
