<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notification', compact('notifications'));

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

       if ($request->hasFile('image')) {
       $file = $request->file('image');
       $path = $file->store('notifications', 'public');
       }

        $data = [

        'title' => $request->title,
        'description' => $request->description,
        'image' => $path ?? null

        ];

     Notification::create($data);
     return redirect()->route('admin.notification.index');

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
    public function edit(Notification $notification)
    {
       $editnotification = $notification;
       $notifications = Notification::all();
       return view('admin.notification', compact('editnotification', 'notifications'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('notifications', 'public');
            Notification::find($notification->id)->update(['image'=>$path]);
        }

        $data = [

            'title' => $request->title,
            'description' => $request->description,

        ];

        $notification=Notification::find($notification->id)->update($data);

        return redirect()->route('admin.notification.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
       $notification->delete();
       return redirect()->route('admin.notification.index');

    }
}
