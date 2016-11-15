<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
use App\Comment;
use App\Notice;
use App\Question;
use Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function getNotices()
	{
		$user=Auth::user();
		$notices=Notice::all();
		$chats=Chat::all();
		return view('notices')->with('user',$user)->with('notices',$notices)->with('chats',$chats);
	}

	public function getHome(){
		$check=Auth::check();
		
		return view('homemain')->with('check',$check);
	}
	public function getHome1()
	{
		$user=Auth::user();
		$chat=Chat::all();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','0')->orderBy('created_at','desc')->take(5)->get();
		return view('home1')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat);
	}

	public function getConfessions()
	{
		$user=Auth::user();
		$chat=Chat::all();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','1')->orderBy('created_at','desc')->get();
		return view('confessions')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat);
	}

	public function getSocieties()
	{
		$user=Auth::user();
		$chat=Chat::all();
		// return view('confessions');
		return view('societies')->with('user',$user)->with('chats',$chat);
	}

	public function getChakravyuh()
	{
		$user=Auth::user();
		$players=User::orderBy('level','desc')->take(5)->get();
		$questions=Question::all();
		$chat=Chat::all();
		return view('chakravyuh')->with('questions',$questions)->with('players',$players)->with('user',$user)->with('chats',$chat);
	}

	public function getProfile()
	{
		$user=Auth::user();
		$chat=Chat::all();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('user_id',$user->id)->where('type','0')->orderBy('created_at','desc')->get();
		return view('profile')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('chats',$chat);

	}
}
