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
use App\Notification;
use Auth;
use Image;
use DB;

class PostController extends Controller
{



    public function checkPost(Request $request)
    {
        $pid=$request->pid;                                                            
         $new=Post::where('id','>',$pid)->get()->count();
         return $new;
    }



    public function store(Request $request)
    {
        $Text=$_POST["mytext"];
        $User=Auth::user();
        $post=new Post;
        $post->user_id=$User->id;
        $post->data=$Text;
        if(Input::hasFile('image'))
        {
            $image=Input::file('image');
            $image_name=time().$image->getClientOriginalName();
            $image->move('uploads',$image_name);
            $post->path='uploads/'.$image_name;
        
        $post->save(); 
        $image=Image::make($post->path)->resize(null,504,function ($constraint) {
    $constraint->aspectRatio();
});
            $image->orientate();
            $image->save($post->path);

        echo '0';
        }
        else
        {
        	$post->save();
        	echo '0';
        	}
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        $image=$post->path;
        Like::where('post_id',$id)->delete();
        Comment::where('post_id',$id)->delete();
        Notification::where('post_id',$id)->delete();
        $post->delete();
        if($image!=NULL)
        File::delete($image);
    }

    public function loadmore(Request $request)
{
    $pid=$request->pid;



    $new=DB::table('posts')->join('users','posts.user_id','=','users.id')->leftJoin('likes',function($join){
        $join->on('posts.user_id','=','likes.user_id');
        $join->on('posts.id','=','likes.post_id');
    })

    ->leftJoin('comments',function($join){
        $join->on('posts.id','=','comments.post_id');
    })
    ->where('posts.id','<',$pid)->orderby('created_at','desc')->take(5)->get(array('posts.*','users.username','users.displaypic','likes.id as like_id' ));

    return $new;

}
}
