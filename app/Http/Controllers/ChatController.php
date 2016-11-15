<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Chat;
use Auth;
use DB;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
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
 		$chats=DB::table('chats')->join('users','chats.user_id','=','users.id')->where('chats.id','>',$mid)->where('chats.user_id','!=',$user)->get(array('chats.*','users.username'));
 		if(count($chats))
 		{
 			return $chats;
 		}
 		else 
 			return '0';
 	}
}
