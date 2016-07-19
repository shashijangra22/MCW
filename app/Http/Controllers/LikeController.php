<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use App\Post;
use App\User;
use Auth;


class LikeController extends Controller
{
    public function setlike(Request $request)
    {
    	if ($request->onezero==0) 
    	{
    		$like=new Like;
	        $like->user_id=$request->user_id;
	        $like->post_id=$request->post_id;
	        $like->save();
            $post=Post::find($request->post_id);
            $post->likes++;
            $post->save();
            return "0";
    	}
    	else
    	{
    		$like=Like::find($request->onezero);
    		$like->delete();
            $post=Post::find($request->post_id);
            $post->likes--;
            $post->save();
    		return "1";
    	}
    }
}
