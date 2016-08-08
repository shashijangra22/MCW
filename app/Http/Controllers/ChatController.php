<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chat;
use Auth;


class ChatController extends Controller
{
    public function sendMessage(Request $request){
    	$user=Auth::user()->id;
    	$message=$request->input('text');
    	$chat=new Chat;
    	$chat->message=$message;
    	$chat->user_id=$user;
    	$chat->save();
    	echo "done";
 	}
 	public function pullMsg(Request $request)
 	{
 		$mid=$request->input('mid');
 		$user=Auth::id();
 		$chats=Chat::where('id','>',$mid)->where('user_id','!=',$user)->get();
 		if($chats->count()>0)
 		{
 		return $chats;
 	}
 		else 
 		return '0';
 	}
 	


}
