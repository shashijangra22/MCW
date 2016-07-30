<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function savecomment(Request $request)
    {
        $comment=new Comment;
        $comment->user_id=$request->user_id;
        $comment->post_id=$request->post_id;
        $comment->data=$request->data;
        $comment->save();
        return "0";
    }
}
