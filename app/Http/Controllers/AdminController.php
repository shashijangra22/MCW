<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
use App\Comment;
use App\Notice;
use App\Question;
use App\Level;
use File;
use Auth;
use DB;

class AdminController extends Controller
{
    public function toggleuser(Request $request)
    {
    	$uid=$request->uid;
    	$state=$request->state;
    	$user=User::find($uid);
        if ($user->active==0) 
        {
            $level=new Level;
            $level->user_id=$uid;
            $level->save();
            $user->active=1;
            $user->save();
            return 'User Activated!';
        }
    	elseif ($user->active==2) 
    	{
	    	$user->active=1;
	    	$user->save();
	    	return 'User Unblocked!';
    	}
    	else
    	{
    		$user->active=2;
	    	$user->save();
	    	return 'User Blocked!';	
    	}
    }
    public function deletepost(Request $request)
    {
    	$pid=$request->pid;
    	$post=Post::find($pid);
        $image=$post->path;
        Like::where('post_id',$pid)->delete();
        Comment::where('post_id',$pid)->delete();
        $post->delete();
        if($image!=NULL)
        File::delete($image);
    	return 'Post Deleted!';
    }

    public function deletecomment(Request $request)
    {
    	$cid=$request->cid;
    	$comment=Comment::find($cid);
    	$comment->delete();
    	$post=Post::find($comment->post->id);
        $post->comments--;
        $post->save();
    	return 'Comment Deleted';
    }

    public function deletechat(Request $request)
    {
    	$chatid=$request->chatid;
    	$chat=Chat::find($chatid);
    	$chat->delete();
    	return 'Message Deleted !';
    }
}
