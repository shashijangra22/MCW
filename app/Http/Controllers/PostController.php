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
            
        $Text=$_POST["mytext"];
        $User=Auth::user();
        $post=new Post;
        $post->user_id=$User->id;
        $post->data=$Text;
        $post->type=$request->type;

        if ($request->type==0) {
                $activity=new Activity;
                $activity->user_id=$User->id;
                $activity->type=0;            
        }

        if(Input::hasFile('image'))
        {
            $image=Input::file('image');
            $image_name=time().$image->getClientOriginalName();
            $image->move('uploads',$image_name);
            $post->path='uploads/'.$image_name;
        
            $post->save();
            $activity->post_id=$post->id;
            $activity->save();
            $image=Image::make($post->path)->resize(null,504,function ($constraint) 
                {
                    $constraint->aspectRatio();
                });
            $image->orientate();
            $image->save($post->path);
            return 0;
        }
        else
        {
        	$post->save();
            if ($request->type==0) {
                $activity->post_id=$post->id;
                $activity->save();
            }
        	return 0;
        }
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        $image=$post->path;
        Like::where('post_id',$id)->delete();
        Comment::where('post_id',$id)->delete();
        Activity::where('post_id',$id)->delete();
        $post->delete();
        if($image!=NULL)
        File::delete($image);
    }

    public function loadmore(Request $request)
    {
        $pid=$request->pid;
        $new=DB::table('posts')->where('posts.id','<',$pid)->where('type','0')->orderby('created_at','desc')->take(5)->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
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
        if ($temp==null) {
            return 0;
        }
        $new=DB::table('posts')->where('posts.id','=',$pid)->where('type','0')->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join)
        {
            $join->on('posts.id','=','likes.post_id')
            ->where('likes.user_id',Auth::id());
            })
        ->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));

        return $new;

    }

}
