<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Discussion;
use Auth;
use DB;

class DiscussionController extends Controller
{
    public function addTopic(Request $request)
    {
    	$user=Auth::user();
    	$discuss = new Discussion;
    	$discuss->user_id=$user->id;
    	$discuss->topic=$request->topic;
    	$discuss->save();
    	return $discuss->id;
    }
}
