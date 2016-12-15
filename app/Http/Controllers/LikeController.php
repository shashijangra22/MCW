<?php

namespace App\Http\Controllers;

use App\Notifications\PostLiked;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Like;
use App\Post;
use App\User;
use App\Activity;
use Auth;
use DB;

class LikeController extends Controller
{
    public function setlike(Request $request)
    {

        $userid=Auth::id();
        $postid=$request->pid;
        if(Like::where('post_id',$postid)->where('user_id',$userid)->exists())
        {
            $existing_like=Like::where('post_id','=',$postid)->where('user_id','=',$userid)->first();
            $post=Post::where('id','=',$postid)->first();
            $post->likes--;
            $post->save();
            $existing_like->delete();
            return 1;
        }
    	else
        {
            $new_like=new Like;
            $new_like->post_id=$postid;
            $new_like->user_id=$userid;
            $new_like->save();
            $post=Post::where('id','=',$postid)->first();
            $post->likes++;
            $post->save();
            if ($post->user_id!=$new_like->user_id && $post->type==0)
                $post->user->notify(new PostLiked ($new_like));
            
            if ($post->type==0) {
                $activity=new Activity;
                $activity->user_id=$userid;
                $activity->post_id=$postid;
                $activity->type=1;
                $activity->save();
            }
            return 0;
        }    
    }

    public function showLikes(Request $request)
    {
        $pid=$request->pid;
        $likes=DB::table('likes')->where('likes.post_id',$pid)->join('users','users.id','=','likes.user_id')->select('likes.*','users.username','users.displaypic')->get();
        return $likes;
    }
}
