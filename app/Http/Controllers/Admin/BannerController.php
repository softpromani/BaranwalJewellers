<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('banners', 'public');
        }

        $data = [
            'image' => $path,
            'path' => $request->url,
        ];

        Banner::create($data);
        return redirect()->route('admin.banner.index');
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
    public function edit(Banner $banner)
    {
        $editbanner = $banner;
        $banners = Banner::all();
        return view('admin.banner', compact('editbanner', 'banners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
       $path = $banner->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('banners', 'public');
        }

        $data = [
            'image' => $path,
            'path' => $request->url,
        ];

        $banner->update($data);

        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banner.index');
    }
}
