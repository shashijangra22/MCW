<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
use App\Level;
use App\Comment;
use App\Notice;
use App\Question;
use App\Activity;
use Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{

	public function getActivity()
	{
		$user=Auth::user();
		$chats=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		$activities=Activity::orderBy('created_at', 'DESC')->take(20)->where('user_id','!=',$user->id)->get();
		return view('activity')->with('user',$user)->with('chats',$chats)->with('activities',$activities);
	}

	public function showAdmin()
	{
		$user=Auth::user();
		$users=User::all();
		$posts=Post::all();
		$chats=Chat::all();
		$likes=Like::all();
		$comments=Comment::all();
		$questions=Question::all();
		// $notices=Notice::all();

		if ($user->username=='beerus') {
			return view('admin')->with('users',$users)->with('posts',$posts)->with('comments',$comments)->with('user',$user)->with('chats',$chats)->with('likes',$likes)->with('questions',$questions);
		}
		return back();
	}

    public function getNotices()
	{
		$user=Auth::user();
		$notices=Notice::all();
		$chats=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		return view('notices')->with('user',$user)->with('notices',$notices)->with('chats',$chats);
	}

	public function getHome(){
		$check=Auth::check();
		
		return view('homemain')->with('check',$check);
	}
	public function getHome1()
	{
		$user=Auth::user();
		$chat=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		$notices=Notice::all();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','0')->orderBy('created_at','desc')->take(5)->get();
		return view('home1')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat)->with('notices',$notices);
	}

	public function getConfessions()
	{
		$user=Auth::user();
		$chat=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','1')->orderBy('created_at','desc')->get();
		return view('confessions')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat);
	}

	public function getSocieties()
	{
		$user=Auth::user();
		$chat=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		return view('societies')->with('user',$user)->with('chats',$chat);
	}

	public function getChakravyuh()
	{
		$user=Auth::user();
		$player=Level::orderBy('level','desc')->orderBy('updated_at','ASC')->take(5)->get(array('levels.level','levels.user_id'));

		$questions=Question::all();
		$chats=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		return view('chakravyuh')->with('questions',$questions)->with('user',$user)->with('chats',$chats)->with('players',$player);
	}

	public function getProfile()
	{
		$user=Auth::user();
		$chat=Chat::orderBy('created_at', 'DESC')->take(100)->get()->reverse();
		$likes=Like::where('user_id',$user->id)->orderBy('created_at','desc')->get(['post_id']);
		$posts=Post::where('user_id',$user->id)->where('type','0')->orderBy('created_at','desc')->get();
		$myActivities=Activity::where('user_id',$user->id)->orderBy('created_at', 'DESC')->take(10)->get();
		$likedposts=[];
		foreach ($likes as $like) {
			if ($like->post->user->id != $user->id)
				$likedposts=array_prepend($likedposts,$like->post);
		}
		return view('profile')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat)->with('likedposts',$likedposts)->with('myActivities',$myActivities);

	}
}
