<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Thread;
use App\Discussion;
use Auth;
use DB;

class ThreadController extends Controller
{
    public function addThread(Request $request)
    {
    	$thread = new Thread;
    	$thread->user_id = Auth::id();
    	$thread->discussion_id = $request->did;
    	$thread->data = $request->data;
    	$thread->save();
    	return 'Thread Added';
    }

    public function getThreads(Request $request)
    {
    	$did = $request->did;
    	$threads=DB::table('threads')->where('discussion_id','=',$did)->join('users','threads.user_id','=','users.id')->get(array('threads.*','users.username'));
		return $threads;  
	}
}
