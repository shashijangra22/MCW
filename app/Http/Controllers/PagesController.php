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
use DB;

class PagesController extends Controller
{


	public function getActivity()
	{
		$user=Auth::user();
		$activities=Activity::orderBy('created_at', 'DESC')->take(20)->where('user_id','!=',$user->id)->get();
		return view('activity')->with('user',$user)->with('activities',$activities);
	}

	public function showAdmin()
	{
		$user=Auth::user();
		if ($user->username=='beerus') {
			return view('admin')->with('user',$user);
		}
		return back();
	}

    public function getNotices()
	{
		$user=Auth::user();
		$notices=Notice::all()->reverse();
		return view('notices')->with('user',$user)->with('notices',$notices);
	}

	public function getHome(){
		$check=Auth::check();
		
		return view('homemain')->with('check',$check);
	}
	public function getHome1()
	{
		$user=Auth::user();
		$notices=Notice::all()->reverse();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','0')->orderBy('created_at','desc')->take(5)->get();
		return view('home1')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('notices',$notices);
	}

	public function getConfessions()
	{
		$user=Auth::user();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('type','1')->orderBy('created_at','desc')->get();
		return view('confessions')->with('posts',$posts)->with('user',$user)->with('likes',$likes);
	}

	public function getSocieties()
	{
		$user=Auth::user();
		return view('societies')->with('user',$user);
	}

	public function getChakravyuh()
	{
		$user=Auth::user();
		$player=Level::orderBy('level','desc')->orderBy('updated_at','ASC')->take(10)->get(array('levels.level','levels.user_id'));

		$questions=Question::all();
		return view('chakravyuh')->with('questions',$questions)->with('user',$user)->with('players',$player);
	}

	public function getProfile()
	{
		$user=Auth::user();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::where('user_id',$user->id)->where('type','0')->orderBy('created_at','desc')->get();
		$myActivities=Activity::where('user_id',$user->id)->orderBy('created_at', 'DESC')->take(10)->get();
		$likedposts=[];
		foreach ($likes as $like) {
			if ($like->post->user->id != $user->id && $like->post->type!=1)
				$likedposts=array_prepend($likedposts,$like->post);
		}
		return view('profile')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('likedposts',$likedposts)->with('myActivities',$myActivities);

	}

	public function userProfile($username)
    {
        $user=Auth::user();
        $user2=User::where('username',$username)->first();
        if (!$user2) {
        	return back();
        }
        $likes=Like::where('user_id',$user->id)->get(['post_id']);
        $likes2=Like::where('user_id',$user2->id)->get();
        $posts=Post::where('user_id',$user2->id)->where('type','0')->orderBy('created_at','desc')->get();
        $myActivities=Activity::where('user_id',$user2->id)->orderBy('created_at', 'DESC')->take(10)->get();
        $likedposts=[];
        foreach ($likes2 as $like2) {
        	if ($like2->post->user->id != $user2->id && $like2->post->type!=1 ) {
        		$likedposts=array_prepend($likedposts,$like2->post);
        	}
        }
        return view('userprofile')->with('user',$user)->with('user2',$user2)->with('likes',$likes)->with('posts',$posts)->with('likedposts',$likedposts)->with('myActivities',$myActivities);
    }

}
