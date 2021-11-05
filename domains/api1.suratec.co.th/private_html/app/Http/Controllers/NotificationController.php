<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;

class NotificationController extends Controller
{

    /**
    * Get all notification
    *
    * @param  String $id_user
    * @return HTTP Response
    */
    public function all($id_user)
    {
        $notifications = Notification::where('id_user',$id_user)->get();
        return response()->json(['data' => $notifications], 200);
    }

    /**
    * Mark notification as Read
    *
    * @param  String $id_user
    * @param  String $id_notification
    * @return HTTP Response
    */
    public function readNotification($id_notification = '', $id_user ='')
    {
        
        $notification = Notification::where('id',$id_notification)->where('id_user',$id_user)->first();

        if ($notification == null) {
            return response()->json(['status' => 'ERROR', 'message' => 'Notification not found'], 404);
        }

        $notification->status = 2;
        if ($notification->save()) {
            return response()->json(['status' => 'OK', 'message' => 'Notification marked as read'], 200);
        }else{
            return response()->json(['status' => 'ERROR', 'message' => 'Unable to marked notification as read'], 422);
        }

    }

}