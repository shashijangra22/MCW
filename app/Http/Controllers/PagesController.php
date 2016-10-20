<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
use App\Comment;
use App\Question;
use App\Notification;
use App\Confession;
use Request;
use Auth;
use Illuminate\Support\Facades\View;
class PagesController extends Controller{

	public function settings()
	{
		$user=Auth::user();
		return view('settings')->with('user',$user);
	}

	public function getHome(){
		$check=Auth::check();
		
		return view('homemain')->with('check',$check);
	}
	public function getHome1()
	{
		$user=Auth::user();
		$user_all=User::all();
		$chat=Chat::all();
		$likes=Like::where('user_id',$user->id)->get(['post_id']);
		$posts=Post::orderBy('created_at','desc')->take(5)->get();
		$notifications=Notification::orderBy('created_at','desc')->get();
		return view('home1')->with('posts',$posts)->with('users',$user_all)->with('user',$user)->with('likes',$likes)->with('chats',$chat)->with('notifications',$notifications);
	}

	public function getConfessions()
	{
		$user=Auth::user();
		$chat=Chat::all();
		$posts=Confession::orderBy('created_at','desc')->get();
		$notifications=Notification::orderBy('created_at','desc')->get();
		return view('confessions')->with('posts',$posts)->with('user',$user)->with('chats',$chat)->with('notifications',$notifications);
	}

	public function getChakravyuh()
	{
		$user=Auth::user();
		$players=User::orderBy('level','desc')->take(5)->get();
		$questions=Question::all();
		$chat=Chat::all();
		$notifications=Notification::orderBy('created_at','desc')->get();
		return view('chakravyuh')->with('questions',$questions)->with('players',$players)->with('user',$user)->with('chats',$chat)->with('notifications',$notifications);
	}

	public function getProfile(){
		$user=Auth::user();
		$comments=Comment::all();
		$likes=Like::where('user_id',$user->id)->get();
		$posts=Post::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(5);
		return view('profile')->with('posts',$posts)->with('user',$user)->with('likes',$likes)->with('comments',$comments);

	}
public function getRandomProfile($user){
		$active_user=Auth::user();
			if($user==$active_user->username)
			{		
					return redirect("profile");
			}
			else
			{
		$users=User::where('username',$user)->get();
		foreach($users as $user1)
		{
			$id=$user1->id;
		}
		$user=User::find($id);
		$posts=Post::where('username',$user->username)->orderBy('created_at','desc')->paginate(5);
		return view('random_profile')->with('posts',$posts)->with('user',$active_user)->with("searched_user",$user);

	}
}



}


?>