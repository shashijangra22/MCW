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
 	public function pullMsg(Request $request,$mid)
 	{
 		//$mid=$request->input('mid');
 		while(1)
 		{

 		$chats=Chat::where('id','>',$mid)->get();
 		if($chats->count()>0)
 		return $chats;
 		else
 		sleep(1);
 	}
 	}


}
