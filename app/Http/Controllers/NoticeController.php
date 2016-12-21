<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Comment;
use App\Question;
use App\Notice;
use Auth;
use DB;

class NoticeController extends Controller
{
    public function addNotice(Request $request)
	{
		$notice=new Notice;
        $notice->data=e($request->mytext);
        $notice->head=e($request->noticeHeader);
        $notice->save();
        return 0;
	}
}
