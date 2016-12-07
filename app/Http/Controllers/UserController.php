<?php

namespace App\Http\Controllers;

use App\Notifications\UserRegistered;
use App\Notifications\ForgotPassword;
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

    public function resetPass(Request $request)     // reset actual password
    {
        $user=User::where('verifytoken',$request->verifytoken)->first();
        if ($user) {
            $user->password=bcrypt($request->newpass);
            $user->verifytoken=str_random(20);
            $user->save();
            return 0;
        }
        return 1;
    }

    public function sendResetMail(Request $request)     // send mail with verify token
    {
        $temp=$request->verifyEmail;
        $user=User::where('email',$temp)->first();
        if ($user) {
            $user->notify(new ForgotPassword($user));   // notify via mail if user exists
            return 0;
        }
        return 1;
    }

    public function resetView($token)   // return reset password page after verifying token
    {
        $user=User::where('verifytoken',$token)->first();
        if ($user!=NULL) {
            return view('resetpassword')->with('user',$user);
        }
        else{
            return "Invalid Token !";
        }
    }

    public function markallread()
    {
        $user=Auth::user();
        $user->unreadNotifications->markAsRead();
        return 0;
    }

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
            return "Your account has been activated ! Enjoy :) ";
        }
        else
        {
            return "Invalid Token !";
        }
    }


    public function loginUser(Request $request)
    {
        $Username=$request->usrname;
        $Password=$request->psswd;
        if (isset($Username) && isset($Password) && !empty($Password) && !empty($Username)) 
        {
            $user=User::where('username',$Username)->first();
            if (isset($user)) 
            {
                if ($user->active==0)
                    return $user->email . ' is not verified! Check your inbox again!';
                elseif ($user->active==2)
                    return 'You are Banned! Contact Admin!';
                else
                {
                    if(Auth::attempt(['username'=> $Username, 'password'=>$Password]))
                    {
                        if(Auth::check())
                            return 0;   // successfully logged in
                    }
                    else
                        return 'Incorrect Password!';
                }
            }
            else
                return 'Incorrect Username!';
        }
        else
            return 'Both fields required!';
    }

    public function registerUser(Request $request)
    {
        $data=$request->all();
        $username=User::where('username',$data['username'])->first();
            if (isset($username))   return 'Oopps ! Username already taken.';
        $email=User::where('email',$data['email'])->first();
            if(isset($email))   return 'Oopps ! Email already exists.';
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
        return 0;   // successully registered
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
        if($fname!=NULL && !empty($fname))
        {
            $user->fname=$fname;
        }
        if($lname!=NULL && !empty($lname))
        {
            $user->lname=$lname;
        }
        if ($usernames->count()>0 && $user->username!=$username)
        {
            return "Username already exists!";
        }
        if($username!=NULL && !empty($username))
        {
            $user->username=$username;
        }
		$user->save();
		return 'Successfully edited :)';
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
                    return 'Success :) Refresh the page to see changes!';
                }
                else
                    return "Not able to upload !";

            
    }
}
