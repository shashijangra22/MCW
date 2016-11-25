<?php

namespace App\Http\Controllers;

use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use File;
use Auth;
use App\Http\Requests;
use App\User;
use App\Level;
use DB;

class UserController extends Controller
{

    public function newnotify(Request $request)
    {
        $lastNotifyTime=$request->lastNotifyTime;
        $user=Auth::user();
        $unread=$user->unreadNotifications->where('created_at','>',$lastNotifyTime);
        if($unread->count())
        {
            foreach ($unread as $temp) {
                $x=User::find($temp->data['user_id'])->username;
                if ($temp->type=='App\Notifications\PostLiked') {
                    $y=0;
                }
                else
                {
                    $y=1;
                }
                $temp['username']=$x;
                $temp['category']=$y;
            }

          return $unread;
        }
        return 0;
    }

    // public function markthisread(Request $request)
    // {
    //     $user=Auth::user();
    //     $x=$user->unreadNotifications->find($request->nid);
    //     if ($x) {
    //         $x->markAsRead();
    //         return 0;
    //     }
    //     return 1;
    // }

    public function verifyUser($token)
    {
        $user=User::where('verifytoken',$token)->first();
        if ($user!=NULL) 
        {
            $user->active=1;
            $user->verifytoken=str_random(20);
            $user->save();
            $level=new Level;
            $level->user_id=$user->id;
            $level->save();
            echo "Your account has been activated ! Enjoy :) ";
        }
        else
        {
            echo "Invalid Token !";
        }
    }

    public function loginUser(Request $request)
    {
        $Username=$request->usrname;
        $Password=$request->psswd;
        if(isset($Username) && isset($Password) && !empty($Password) && !empty($Username))
        {
            if(Auth::attempt(['username'=> $Username, 'password'=>$Password, 'active'=>1]))
            {
                if(Auth::check())
                {
                    echo 0;
                }
            }
            else
            {
                echo 1;
            }
        }
        else
            echo 2;
    }

    public function registerUser(Request $request)
    {
        $data=$request->all();
        $user=User::where('username',$data['username']);
        $email=User::where('email',$data['email']);

        if ($user->count()>0)
        {
            return 1;
        }
        elseif($email->count()>0)
        {
            return 2;
        }

        else
        {
            $user=User::create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'verifytoken' => str_random(20),
                'active' => 0,
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
            ]);
            $user->notify(new UserRegistered($user)); //Notify user through mail
            return 0;
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('');
    }

    public function updateProfile(Request $request)
    {
        $fname=$request->fname;
        $lname=$request->lname;
        $username=$request->username;
        $user=Auth::user();
        $usernames=User::where('username',$username);
        if ($usernames->count()>0 && $user->username!=$username)
        {
            return "Username already exists!";
        }
        if($fname!=NULL && !empty($fname))
        {
            $user->fname=$fname;
        }

        if($lname!=NULL && !empty($lname))
        {
            $user->lname=$lname;
        }
        if($username!=NULL && !empty($username))
        {
            $user->username=$username;
        }
		$user->save();
		echo '0';
	}

	public function updatePic(Request $request,$id)
    {

                if(Input::hasFile('pic'))
                {
                   $user=User::find($id);
                   $ppath=$user->displaypic;
                   $pic=Input::file('pic');
                   $pic_name=time().$pic->getClientOriginalName();
                   $cpath='profile_pic/'.$pic_name;
                   $pic->move('profile_pic',$pic_name);
                if($user->displaypic!="profile_pic/default.png")
                {
                       File::delete($ppath);
                }
                    $user->displaypic=$cpath; 
                    $user->save();
                    echo '0';
                }
                else
                    echo "not able to upload";

            
    }
}
