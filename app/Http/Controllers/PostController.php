<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Activity;
use Auth;
use Image;
use DB;

class PostController extends Controller
{
    public function store(Request $request)
    {

        if($request->type!=1 && $request->type!=0 )
            return $type;
        $uid=Auth::id();
        $post=new Post;
        $post->user_id=$uid;
        $post->data=e($request->mytext);
        $post->type=$request->type;

        if(Input::hasFile('image'))
        {
            $image=Input::file('image');
            $image_name=time().'.jpg';

            Image::make($image)->resize(null, 504,function ($constraint)
            {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('uploads/'.$image_name);

            $post->path='uploads/'.$image_name;
        }
        $post->save();
        if ($request->type==0) {
            $activity=new Activity;
            $activity->user_id=$uid;
            $activity->type=0;      
            $activity->post_id=$post->id;
            $activity->save();   
        }
        return 0;
    }

    public function delpost(Request $request)
    {
        $pid=$request->pid;
        $post=Post::find($pid);
        if($post->user->id!=Auth::id()) return 'You can not delete this post!';
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

    public function loadmore(Request $request)
    {
        $pid=$request->pid;
        if ($pid<0) {
            $new=DB::table('posts')->where('type','0')->orderby('created_at','desc')->take(5)->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
            {
                $join->on('posts.id','=','likes.post_id')
                ->where('likes.user_id',Auth::id());
                })
            ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));
        }
        else{
            $new=DB::table('posts')->where('posts.id','<',$pid)->where('type','0')->orderby('created_at','desc')->take(5)->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
            {
                $join->on('posts.id','=','likes.post_id')
                ->where('likes.user_id',Auth::id());
                })
            ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));
        }
        return $new;

    }

    public function myProfilePosts()
    {
        $new=DB::table('posts')->where('posts.user_id',Auth::id())->where('type','0')->orderby('created_at','desc')->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
            {
                $join->on('posts.id','=','likes.post_id')
                ->where('likes.user_id',Auth::id());
                })
            ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));

        return $new;
    }
    public function userProfilePosts(Request $request)
    {
        $new=DB::table('posts')->where('posts.user_id',$request->uid)->where('type','0')->orderby('created_at','desc')->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
            {
                $join->on('posts.id','=','likes.post_id')
                ->where('likes.user_id',Auth::id());
                })
            ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));

        return $new;
    }

    public function getpost(Request $request)
    {
        $user=Auth::user();
        $pid=$request->pid;
        $temp=Post::find($pid);
        if ($temp==null)    return 0;
        $new=DB::table('posts')->where('posts.id','=',$pid)->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
        {
            $join->on('posts.id','=','likes.post_id')
            ->where('likes.user_id',Auth::id());
            })
        ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));
        return $new;
    }
}
