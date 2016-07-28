<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Like;
use App\Chat;
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
		
		return view('home')->with('check',$check);
	}
	public function getHome1()
	{
		$user=Auth::user();
		$user_all=User::all();
		$chat=Chat::all();
		$likes=Like::where('user_id',$user->id)->get();
		$posts=Post::orderBy('created_at','desc')->paginate(5);
		return view('home1')->with('posts',$posts)->with('users',$user_all)->with('user',$user)->with('likes',$likes)->with('chats',$chat);
	}
	public function test(){
		echo 'hello';
	}

	public function getProfile(){
		$user=Auth::user();
		$likes=Like::where('user_id',$user->id)->get();
		$posts=Post::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(5);
		return view('profile')->with('posts',$posts)->with('user',$user)->with('likes',$likes);

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