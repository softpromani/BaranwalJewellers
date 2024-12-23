<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::paginate(10);
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

       if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('notifications', 'public');
       }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path ?? Null
        ];

        Notification::create($data);

        // Prepare Firebase notification payload
        $fcmToken = User::active()->pluck('fcm_token'); // Replace with the recipient's FCM token
        $serverKey = 'YOUR_SERVER_KEY_HERE'; // Replace with your Firebase server key

        $firebaseData = [
            'message' => [
                'token' => $fcmToken,
                'notification' => [
                    'title' => $request->title,
                    'body' => $request->description,
                ],
                'data' => [
                    'image' => $path ?? null,
                ],
            ],
        ];

        // Send notification to Firebase
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/v1/projects/YOUR_PROJECT_ID/messages:send', $firebaseData);

        if ($response->failed()) {
            return redirect()->route('admin.notification.index')
                ->with('error', 'Notification created but failed to send push notification.');
        }

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
