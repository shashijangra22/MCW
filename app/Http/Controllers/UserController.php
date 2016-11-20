<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use File;
use Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function verifyUser($token)
    {
        $user=User::where('verifytoken',$token)->first();
        if ($user->count()>0) 
        {
            $user->active=1;
            $user->save();
            echo "Your account has been activated ! Enjoy :) ";
        }
        else
        {
            echo "Invalid Token !";
        }
    }

    public function loginUser(Request $request)
    {
        $Username=$_POST["usrname"];
        $Password=$_POST["psswd"];
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
        $email=User::where('email',$_POST['email']);
        $user=User::where('username',$_POST['username']);
        if ($user->count()>0)
        {
            echo 1;
        }
        elseif($email->count()>0)
        {
            echo 2;
        }

        else
        {
            $Fname=($_POST['fname']);
            $Lname=($_POST['lname']);
            $Email=($_POST['email']);
            $Password=($_POST['password']);
            $Username=($_POST['username']);
            $post=new User;
            $post->password=bcrypt($Password);
            $post->fname=$Fname;
            $post->lname=$Lname;
            $post->username=$Username;
            $post->email=$Email;
            $post->level=0;
            $post->active=0;
            $randomToken=str_random(20);
            $post->verifytoken=$randomToken;
            $post->save();
            // sendmail($Email);

            Mail::send('emails.test',['name' => $Fname,'token' => $randomToken],function($message) use ($post)
            {
                $message->from('admin@mycollegewall.com','MCW');
                $message->to($post->email,$post->fname)->subject('Welcome to MCW!');
            });

            echo 0;
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
