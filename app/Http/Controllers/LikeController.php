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

        $userid=Auth::id();
        $postid=$request->post_id;
        if(Like::where('post_id',$postid)->where('user_id',$userid)->exists())
        {
            $existing_like=Like::where('post_id','=',$postid)->where('user_id','=',$userid)->first();
            $existing_like->delete();
            return 'unlike';


            
        }
    	else
        {
            $new_like=new Like;
            $new_like->post_id=$postid;
            $new_like->user_id=$userid;
            $new_like->save();
            return 'like';
        }

    	
    
}
}
