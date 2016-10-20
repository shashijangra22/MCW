<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Notification;
use Auth;
use Image;
use DB;

class NotificationController extends Controller
{
    public function notify(Request $request)
    {
    	$notifyid=$request->notifyid;
    	$number=Notification::where('id','>',$notifyid)->get()->count();
    	return $number;
    }
}
