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
use App\Confession;
use Auth;
use Image;
use DB;

class ConfessionController extends Controller
{
    public function store(Request $request)
    {
        $Text=$_POST["mytext"];
        $User=Auth::user();
        $post=new Confession;
        $post->user_id=$User->id;
        $post->data=$Text;
    	$post->save();
    	echo '0';
    }
}
