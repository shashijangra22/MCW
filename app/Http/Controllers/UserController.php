<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use File;
use Auth;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $Username=$_POST["username"];
        $Password=$_POST["password"];
        if(isset($Username) && isset($Password) && !empty($Password) && !empty($Username))
        {
            if(Auth::attempt(['username'=> $Username, 'password'=>$Password]))
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
            $post->save();

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
        



        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
