<?php

namespace App\Http\Controllers;

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
    	$user_id=Auth::id();
        $comment=new Comment;
        $comment->user_id=$user_id;
        $comment->post_id=$request->post_id;
        $comment->data=$request->data;
        $comment->save();
        return "0";
    }
    public function showComments(Request $request)
    {
        $pid=$request->pid;
        $comments=DB::table('comments')->where('comments.post_id',$pid)->join('users','users.id','=','comments.user_id')->select('comments.*','users.username','users.displaypic')->get();
        return $comments;
    }
}
