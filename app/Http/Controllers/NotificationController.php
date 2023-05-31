<?php

namespace App\Http\Controllers;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;


class NotificationController extends Controller
{    /**
     * Display the specified resource.
     */
    public function showAll(string $email)
    {
        //
        $notifications = notification::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($notification) {
                $notification->formattedTime = Carbon::parse($notification->created_at)->format('h.i A');
                return $notification;
            });

            $response = response()->json($notifications);
        
            return $response;
    }

    public function showLatest(string $email)
    {
        $notifications = notification::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($notification) {
                $notification->formattedTime = Carbon::parse($notification->created_at)->format('h.i A');
                return $notification;
            });
        
            $response = response()->json($notifications);
        
            return $response;
    }

    public function updateStatus(Request $request)
    {
        $updatedNotifications = $request->input('notifications');
        foreach ($updatedNotifications as $updatedNotification) {
            $notification = notification::where('notification_id', $updatedNotification['notification_id'])->first();
            if ($notification) {
                $notification->read = true;
                $notification->save();
                Log::info($notification);
            }
        }

        return response()->json(['message' => 'Notification statuses updated successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
