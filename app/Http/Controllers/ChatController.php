<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Chat;
use Auth;
use DB;

class ChatController extends Controller
{

	public function initialMsgs()
	{
		$chats=DB::table('chats')->orderBy('created_at','DESC')->take(100)->join('users','chats.user_id','=','users.id')->get(array('chats.*','users.username'));
		return array_reverse($chats->toArray());
	}

    public function sendMsg(Request $request)
    {
    	$id=Auth::id();
    	$chat=new Chat;
    	$chat->message=e($request->text);
    	$chat->user_id=$id;
    	$chat->save();
    	return 0;
 	}

 	public function pullMsg(Request $request)
 	{
 		$msgId=$request->id;
 		$userId=Auth::id();
 		$chats=DB::table('chats')->where('chats.id','>',$msgId)->where('chats.user_id','!=',$userId)->join('users','chats.user_id','=','users.id')->get(array('chats.*','users.username'));
 		if($chats->count())
 		{
 			return $chats;
 		}
 		else 
 			return 0;
 	}
}
