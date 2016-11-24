<?php

namespace App\Http\Controllers;

use App\Notifications\PostCommented;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use Auth;
use DB;

class CommentController extends Controller
{
    public function savecomment(Request $request)
    {
        $postid=$request->post_id;
    	$user_id=Auth::id();
        $comment=new Comment;
        $comment->user_id=$user_id;
        $comment->post_id=$postid;
        $comment->data=$request->data;
        $comment->save();
        $post=Post::where('id','=',$postid)->first();
        $post->comments++;
        $post->save();
        if ($post->user_id!=$comment->user_id)
                $post->user->notify(new PostCommented($comment));
        return "0";
    }
    public function showComments(Request $request)
    {
        $pid=$request->pid;
        $comments=DB::table('comments')->where('comments.post_id',$pid)->join('users','users.id','=','comments.user_id')->select('comments.*','users.username','users.displaypic')->get();
        return $comments;
    }
}
