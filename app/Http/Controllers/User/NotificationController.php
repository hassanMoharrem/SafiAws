<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $columnName = ($lang == 'ar') ? 'body_ar' : 'body';
        $user = User::find(auth()->id());
        $notifications = $user->notifications()->simplePaginate(10);

        // Loop through the collection and modify the data property
        $filteredData = $notifications->map(function ($item) use ($columnName) {
            $data = $item->data;
            $item->data = $data[$columnName];
            if ($columnName === 'body'){
                unset($data[$columnName]);
            }else{
                unset($data['body_ar']);
            }
            return $item;
        });

        return response()->json([
            'success' => '200',
            'notifications' => $filteredData,
        ]);
    }
    public function showUnread(Request $request){
        $lang = $request->header('Accept-Language') ?? 'en';
        $columnName = ($lang == 'ar') ? 'body_ar' : 'body';
        $user = User::query()->find(auth()->id());
        $notifications_unread = $user->unreadNotifications()->simplePaginate(10);
        $notifications_unread_count = $user->unreadNotifications()->count();
        // Loop through the collection and modify the data property
        $filteredData = $notifications_unread->map(function ($item) use ($columnName) {
            $data = $item->data;
            $item->data = $data[$columnName];
            if ($columnName === 'body'){
                unset($data[$columnName]);
            }else{
                unset($data['body_ar']);
            }
            return $item;
        });

        return response()->json([
            'notifications_unread' => $filteredData,
            'notifications_unread_count' =>$notifications_unread_count,
        ]);
    }
    public function showRead(Request $request){
        $lang = $request->header('Accept-Language') ?? 'en';
        $columnName = ($lang == 'ar') ? 'body_ar' : 'body';
        $user = User::query()->find(auth()->id());
        $notifications_read = $user->readNotifications()->simplePaginate(10);
        $notifications_read_count = $user->readNotifications()->count();
        $filteredData = $notifications_read->map(function ($item) use ($columnName) {
            $data = $item->data;
            $item->data = $data[$columnName];
            if ($columnName === 'body'){
                unset($data[$columnName]);
            }else{
                unset($data['body_ar']);
            }
            return $item;
        });
        return response()->json([
            'notifications_read' => $filteredData,
            'notifications_read_count' =>$notifications_read_count,
        ]);
    }
    public function destroy($id)
    {
        DatabaseNotification::find($id)->markAsRead();
        return response()->json([
            'success'=>'200',
            'message'=>'Delete Notification Success'
        ]);
    }
}
