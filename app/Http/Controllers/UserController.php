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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        
        //
        //if(Request::ajax()){
            
            //$post=new Post;

        $Username=$_POST["username"];
        $Password=$_POST["password"];
        if(isset($Username) && isset($Password) && !empty($Password) && !empty($Username))
        {
        if(Auth::attempt(['username'=> $Username, 'password'=>$Password]))
        {
            
            if(Auth::check())
            {
                Session::put('username',$Username);

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


        //}
    }

    public function registerUser(Request $request)
    {
        //
        //if(Request::ajax()){
            
            //$post=new Post;
        $email=User::where('email',$_POST['email']);
        $user=User::where('username',$_POST['username']);
        if ($user->count()>0)
        {
            echo "username already taken";
        }
        elseif($email->count()>0)
        {
            echo "E-mail already registered";
        }

        else
        {
        $Fname=($_POST['fname']);
    $Lname=($_POST['lname']);
    $Department=($_POST['department']);
    $Year=($_POST['year']);
    $Gender=($_POST['gender']);
    $Email=($_POST['email']);
    $Password=($_POST['password']);
    $Username=($_POST['username']);
    $post=new User;
    $post->password=bcrypt($Password);
    $post->fname=$Fname;
    $post->lname=$Lname;
    $post->username=$Username;
    $post->gender=$Gender;
    $post->department=$Department;
    $post->year=$Year;
    $post->email=$Email;
    $post->save();

    echo '<i class="fa fa-star"></i><h4>Thank you for registering.</h4>';
}



        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logoutUser()
    {
        //
        
        Auth::logout();
        Session::flush();
    //header("location:\\");
    return Redirect::to('');

    //window.location.replace('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
        $fname=Input::get("fname");
        $lname=Input::get("lname");
        $dob=Input::get("dob");
        $contact=Input::get("contact");
        $user=Auth::user();
        if($fname!=NULL && !empty($fname))
        {
            $user->fname=$fname;
        }

        if($lname!=NULL && !empty($lname))
        {
                $user->lname=$lname;

            }
            if($contact!=NULL && !empty($contact))
            {
                $user->contact=$contact;
            }



                if($dob!=NULL && !empty($dob))
                {
                        $user->dob=$dob;
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
