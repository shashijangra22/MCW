<?php

namespace App\Http\Controllers;

use App\Notifications\PostCommented;
use App\Notifications\UserMentioned;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Activity;
use Auth;
use DB;

class CommentController extends Controller
{
    public function savecomment(Request $request)
    {
        $postid=$request->pid;
    	$user_id=Auth::id();
        $comment=new Comment;
        $comment->user_id=$user_id;
        $comment->post_id=$postid;
        $comment->data=e($request->data);
        $comment->save();
        $post=Post::find($postid);
        $post->comments++;
        $post->save();

        if ($post->type==0) {
            if ($post->user_id!=$comment->user_id)
                $post->user->notify(new PostCommented($comment));

            preg_match_all("/(@\w+)/", $request->data, $matches);
            foreach ($matches[0] as $temp){
                $username=substr($temp, 1);
                $user = User::where('username',$username)->first();
                if ($user && $username!=$comment->user->username) {
                    $user->notify(new UserMentioned($comment));
                }
            }
            $activity=new Activity;
                $activity->user_id=$user_id;
                $activity->post_id=$postid;
                $activity->type=2;
                $activity->save();
        }
        return 0;
    }
    public function showComments(Request $request)
    {
        $pid=$request->pid;
        $comments=DB::table('comments')->where('comments.post_id',$pid)->join('users','users.id','=','comments.user_id')->select('comments.*','users.username','users.displaypic')->get();
        return $comments;
    }
}
