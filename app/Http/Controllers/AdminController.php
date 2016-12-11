<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
use App\Comment;
use App\Notice;
use App\Question;
use App\Level;
use App\Activity;
use File;
use Auth;
use DB;

class AdminController extends Controller
{

    public function getusers(Request $request){
        $id=$request->id;
        if ($id==0) {
            $users=User::orderBy('id','DESC')->take(4)->get();
        }
        else
        {
            $users=User::orderBy('id','DESC')->where('id','<',$id)->take(8)->get();
        }
        return (isset($users)) ? $users : 1;
    }

    public function searchuser(Request $request){
        $user=User::where('username',$request->data)->first();
        return (isset($user)) ? $user : 1;
    }

    public function toggleuser(Request $request){
        $uid=$request->uid;
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

    public function getposts(Request $request){
        $id=$request->id;
        if ($id==0) {
            $posts=Post::orderBy('id','DESC')->take(3)->get();
        }
        else
        {
            $posts=Post::orderBy('id','DESC')->where('id','<',$id)->take(6)->get();
        }
        return (isset($posts)) ? $posts : 1;
    }

    public function deletepost(Request $request){
        $pid=$request->pid;
        $post=Post::find($pid);
        if (isset($post)) {
            $image=$post->path;
            Like::where('post_id',$pid)->delete();
            Comment::where('post_id',$pid)->delete();
            Activity::where('post_id',$pid)->delete();
            $post->delete();
            if($image!=NULL)
                File::delete($image);
            return 'Post Deleted!';
        }
        return 'Already Deleted!';
    }

    public function getcomments(Request $request){
        $id=$request->id;
        if ($id==0) {
            $comments=Comment::orderBy('id','DESC')->take(4)->get();
        }
        else
        {
            $comments=Comment::orderBy('id','DESC')->where('id','<',$id)->take(8)->get();
        }
        return (isset($comments)) ? $comments : 1;
    }    

    public function deletecomment(Request $request){
        $cid=$request->cid;
        $comment=Comment::find($cid);
        if (isset($comment)) {
            $comment->delete();
            $post=Post::find($comment->post->id);
            $post->comments--;
            $post->save();
            return 'Comment Deleted';
        }
        return 'Post Already Deleted!';
    }

    public function getquestions(Request $request){
        $id=$request->id;
        if ($id==0) {
            $questions=question::orderBy('id','DESC')->take(3)->get();
        }
        else
        {
            $questions=question::orderBy('id','DESC')->where('id','<',$id)->take(4)->get();
        }
        return (isset($questions)) ? $questions : 1;
    }

    public function addQuestion(Request $request)
    {
        $question=new Question;
        $question->data=$request->qBox;
        $question->answer=$request->answerBox;
        if (Input::hasFile('image')) 
        {
            $image=Input::file('image');
            $image_name=time().$image->getClientOriginalName();
            $image->move('uploads',$image_name);
            $question->path='uploads/'.$image_name;
                $question->save();
            return 'Question Added!';
        }
        return 'Failure!';
    }

    public function addHint(Request $request)
    {
        $id=$request->questionid;
        $hint=$request->hint;
        if($question=Question::find($id))
        {
            $question->data=$question->data."\n".$hint;
            $question->save();
            return 'Hint Updated!';
        }
        return 'Invalid Id!';
    }
}
