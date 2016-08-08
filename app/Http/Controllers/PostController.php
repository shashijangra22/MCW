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
use Auth;
use Image;

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
        $post->delete();
        if($image!=NULL)
        File::delete($image);
    }
}
