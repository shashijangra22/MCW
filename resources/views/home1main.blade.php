<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Our College's Own Social Network">
    <meta name="author" content="Shashi-Saurav-Vishul-Aman">

    <title>My College Wall</title>

	<link rel="stylesheet" type="text/css" href="{{asset('css/scroll.css')}}">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">

      <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
</head>
<body>

<div class="spinner-wrapper white valign-wrapper" style="position: fixed;top: 0;left: 0;right: 0;bottom: 0;z-index: 999999">
	<div class="preloader-wrapper active" style="margin: auto;">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
</div>

	<div class="navbar-fixed">
	      <!-- Dropdown Structure -->
	      <ul id="dropdown1" class="dropdown-content">
	        <li><a href="{{asset('profile')}}"><i style="margin: 0px;" class="fa fa-user"></i> My Profile</a></li>
	        <li><a href="{{asset('logout')}}"><i style="margin: 0px;" class="fa fa-reply"></i> Logout</a></li>
	      </ul>
	      <ul id="dropdown2" class="dropdown-content">
	      </ul>
	  <nav class="blue">
	    <div class="nav-wrapper">
	      <a style="font-size: 24px;" href="{{asset('home')}}" class="brand-logo">My College Wall</a>
	      <a style="cursor: pointer;" data-activates="slide-out" class="button-collapse"><i style="font-size: 20px" class="fa fa-bars"></i></a>
	      <a style="padding-right: 20px;cursor: pointer;" class="notifyBtn dropdown-button right" data-constrainwidth="false" data-beloworigin="true" data-activates="dropdown2"><i style="margin: 0px;height: auto;" class="fa fa-bell"></i></a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li class="active homeBtn"><a href="{{asset('home')}}"><i class="fa fa-home"></i> Home</a></li>
	          <li class="confessionsBtn"><a href="{{asset('confessions')}}"><i class="fa fa-heartbeat"></i> Confessions</a></li>
	          <li class="activityBtn"><a href="{{asset('activity')}}"><i class="fa fa-users"></i> Activity Log</a></li>
	          <!-- <li class="societiesBtn"><a href="{{asset('societies')}}">Societies</a></li> -->
	          <li class="chakravyuhBtn"><a href="{{asset('chakravyuh')}}"><i class="fa fa-empire"></i> Chakravyuh</a></li>
	          <li class="noticesBtn"><a href="{{asset('notices')}}"><i class="fa fa-info-circle"></i> Notices</a></li>
	          <li class="profileBtn"><a class="dropdown-button" data-constrainwidth="false" data-beloworigin="true" data-activates="dropdown1" style="cursor: pointer;">
	            <div class="chip white">
	              {{$user->username}}
	              <img src="{{asset($user->displaypic)}}">
	            </div>
	          </a></li>
	      </ul>
	      	<ul id="slide-out" class="side-nav">
	          <li><div class="userView">
	            <!-- <img class="background" src="img/5.jpg"> -->
	            <a style="cursor: pointer;"><img class="circle" src="{{asset($user->displaypic)}}"></a>
	            <a style="cursor: pointer;"><span class="name">{{$user->username}}</span></a>
	            <a style="cursor: pointer;"><span class="email">{{$user->email}}</span></a>
	          </div></li>
	          <li class="homeBtn active"><a href="{{asset('home')}}"><i style="margin: 0px;" class="fa fa-home"></i> Home</a></li>
	          <li class="confessionsBtn"><a href="{{asset('confessions')}}"><i style="margin: 0px;" class="fa fa-heartbeat"></i> Confessions</a></li>
	          <!-- <li class="societiesBtn"><a disabled="true" href="{{asset('societies')}}">Societies</a></li> -->
	          <li class="activityBtn"><a href="{{asset('activity')}}"><i style="margin: 0px;" class="fa fa-users"></i> Activity Log</a></li>
	          <li class="chakravyuhBtn"><a href="{{asset('chakravyuh')}}"><i style="margin: 0px;" class="fa fa-empire"></i> Chakravyuh</a></li>
	          <li class="noticesBtn"><a href="{{asset('notices')}}"><i style="margin: 0px;" class="fa fa-info-circle"></i> Notices</a></li>
	          <li><div class="divider"></div></li>
	          <li class="profileBtn"><a href="{{asset('profile')}}"><i style="margin: 0px;" class="fa fa-user"></i> My Profile</a></li>
	          <li><a href="{{asset('logout')}}"><i style="margin: 0px;" class="fa fa-reply"></i> Logout</a></li>
	          </ul>
	    	</div>
	  </nav>
	</div>

<div class="card feed z-depth-4" id="prototype" style="display: none">
    <div class="card-content" style="padding: 10px 10px 5px 10px;">
          <div class="row" style="margin-bottom: 10px">
            <div class="col s2 m1">
              <a class="postUserImg"><img class="circle left postUserImg" width="35" height="35"></a>
            </div>
            <div class="col s8 m10">
              <p>By <a class="postUsername"></a></p>
              <p style="font-size: 10px"><strong class="timestamp"></strong></p>
            </div>
            <div class="col s2 m1 deleteBtn">
            </div>
          </div>
          <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
          </blockquote>
          <a class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;"></a>
          <a class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline"></a>
        <i style="display: none;" class="fa fa-spinner fa-pulse"></i>
          <div class="likesBox" style="display: none;"></div>
          <div class="commentsBox" style="display: none"></div>
    </div>
        <div class="card-action" style="padding: 0px 10px 0px 10px;">
          <div class="row" style="padding-top: 0px;margin-bottom: auto;">
              <div class="col s2 m1" style="padding-top: 10px">
          <i style="color:red;cursor:pointer;font-size: 32px" class="likeBtn left material-icons"></i>
      </div>
          <div class="col s8 m10">
            <input class="comment_input" style="margin-bottom: 10px" type="text" placeholder="write a comment :)">
          </div>
            <div class="col s2 m1" style="padding-top: 10px">
              <i style="color: grey;cursor: pointer;font-size: 32px" class="commentBtn right material-icons">send</i>
              <div class="hide commentSpinner preloader-wrapper small right active">
                  <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                      <div class="circle"></div>
                    </div><div class="gap-patch">
                      <div class="circle"></div>
                    </div><div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
  </div>

<div id="maindiv" class="container">
	@yield('content')
</div>


  <!-- Modal Structure -->
<div id="modal1" class="modal" style="max-height: 80%">
	<div class="modal-content" id="loadpost" style="padding-left: 10px;padding-right: 10px;padding-bottom: 0px;padding-top: 5px">
	</div>
</div>

<div id="chat-slide-out"  class="side-nav">
    <div class="row card blue valign-wrapper" style="padding-top: 0px;margin: auto;height: 10%;">
    	<div class="col s12 center-align">
    		<span class="white-text card-title">Chatbox</span>
    	</div>
        </div>
      <div id="scroll-chat" class="scrollbar" style="height: 80%">
        <div id="chatbox" class="scrollbox-content " style="padding-top: 5px;padding-left: 5px">
        	 
        </div>
      </div>
        <div class="row valign-wrapper" style="margin: auto;height: 10%">
          <div class="col s2 m2" style="padding-top: 20px;padding-right: 0px">
                <a style="padding: 0px" onclick="hideChatBox();"><i style="font-size: 32px" class="material-icons">reply</i></a>
              </div>
              <div class="col s8 m8" style="padding-left: 0px;padding-right: 0px">
                <input style="margin-bottom: 0px;" onkeydown = "if (event.keyCode == 13) $('#sendBtn').click();" type="text" placeholder="Enter your message :)">
              </div>
              <div class="col s2 m2" style="padding-top: 20px">
              	<a style="padding: 0px" id="sendBtn"><i id="sendIcon" class="material-icons" style="font-size: 32px">send</i></a>
              </div>
        </div>
  </div>


<div class="fixed-action-btn" style="bottom: 10; right: 10;">
    <a class="chat-button btn-floating btn-large" data-activates="chat-slide-out">
      <i class="material-icons">chat</i>
    </a>
</div>
</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
   <script type="text/javascript" src="{{asset('js/myjs.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/linkify.min.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/linkify-jquery.min.js')}}" ></script>

@yield('JSwithTags')

<script type="text/javascript">
var auth_id={{Auth::id()}};
var auth_displaypic="{{$user->displaypic}}";
var auth_username="{{$user->username}}";
@yield('jscript')

</script>
</html>