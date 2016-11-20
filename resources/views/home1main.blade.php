<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Our College Own Social Network">
    <meta name="author" content="Saurav-Shashi-Vishul-Aman">

    <title>My College Wall</title>

	<link rel="stylesheet" type="text/css" href="css/scroll.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

      <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

</head>
<body>

<div class="spinner-wrapper white" style="position: fixed;top: 0;left: 0;right: 0;bottom: 0;z-index: 999999">
	<div class="preloader-wrapper big active" style="position: absolute;top: 45%;left: 45%">
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
	        <li><a href="{{asset('profile')}}"><i style="margin: 0px;height: auto;" class="fa fa-user"></i> My Profile</a></li>
	        <li><a href="{{asset('logout')}}"><i style="margin: 0px;height: auto;" class="fa fa-reply"></i> Logout</a></li>
	      </ul>
	  <nav class="blue">
	    <div class="nav-wrapper">
	      <a style="font-size: 24px;padding-left: 20px" href="{{asset('home')}}" class="brand-logo left">My College Wall</a>
	      <a style="padding-right: 20px" href="#" data-activates="slide-out" class="button-collapse right"><i style="font-size: 24px" class="fa fa-bars"></i></a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li class="active homeBtn"><a href="{{asset('home')}}"><i class="fa fa-home"></i> Home</a></li>
	          <li class="confessionsBtn"><a href="{{asset('confessions')}}"><i class="fa fa-heartbeat"></i> Confessions</a></li>
	          <!-- <li class="societiesBtn"><a href="{{asset('societies')}}">Societies</a></li> -->
	          <li class="chakravyuhBtn"><a href="{{asset('chakravyuh')}}"><i class="fa fa-empire"></i> Chakravyuh</a></li>
	          <li class="noticesBtn"><a href="{{asset('notices')}}"><i class="fa fa-info-circle"></i> Notices</a></li>
	          <li class="profileBtn"><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="dropdown1">
	            <div class="chip white">
	              {{$user->username}}
	              <img src="{{$user->displaypic}}">
	            </div>
	          </a></li>
	      </ul>
	      	<ul id="slide-out" class="side-nav">
	          <li><div class="userView">
	            <!-- <img class="background" src="img/5.jpg"> -->
	            <a href="#"><img class="circle" src="{{$user->displaypic}}"></a>
	            <a href="#"><span class="name">{{$user->username}}</span></a>
	            <a href="#"><span class="email">{{$user->email}}</span></a>
	          </div></li>
	          <li class="homeBtn active"><a href="{{asset('home')}}"><i style="margin: 0px;height: auto;" class="fa fa-home"></i> Home</a></li>
	          <li class="confessionsBtn"><a href="{{asset('confessions')}}"><i style="margin: 0px;height: auto;" class="fa fa-heartbeat"></i> Confessions</a></li>
	          <!-- <li class="societiesBtn"><a disabled="true" href="{{asset('societies')}}">Societies</a></li> -->
	          <li class="chakravyuhBtn"><a href="{{asset('chakravyuh')}}"><i style="margin: 0px;height: auto;" class="fa fa-empire"></i> Chakravyuh</a></li>
	          <li class="noticesBtn"><a href="{{asset('notices')}}"><i style="margin: 0px;height: auto;" class="fa fa-info-circle"></i> Notices</a></li>
	          <li><div class="divider"></div></li>
	          <li class="profileBtn"><a href="{{asset('profile')}}"><i style="margin: 0px;height: auto;" class="fa fa-user"></i> My Profile</a></li>
	          <li><a href="{{asset('logout')}}"><i style="margin: 0px;height: auto;" class="fa fa-reply"></i> Logout</a></li>
	          </ul>
	    	</div>
	  </nav>
	</div>


<!-- prototype -->

<div class="card z-depth-4 feed" id="prototype" style="display: none;">
				<div class="card-image protoimage" style="display: none;">
	              <img class="materialboxed" src=""/>
	            </div>
	            <div class="card-content" style="padding-top: 10px;padding-bottom: 5px">
	              <div class="row" style="padding-top: 5px; margin-bottom: 10px">
		              <div class="col s2 m1 ">
		                <img src="" class="circle left protodisplaypic" width="35" height="35">
		              </div>
		              <div class="col s8 m10">
		                <p>By <strong class="protousername"></strong></p>
		                <p style="font-size: 10px"><strong class="prototimestamp"></strong></p>
		              </div>
		              <div class="col s2 m1 protodelete">
		                
		          
		              </div>
	            </div>
	              <blockquote style="text-align: justify;margin-top: 0px;margin-bottom: 10px" class="protodata">
	              </blockquote>
	              <p id="protolikes" class="chip likescount blue white-text" style="padding: 6px;display: inline" data-id=""></p>
	              <p id="protocomments" data-id="" class="chip commentscount blue white-text" style="padding: 6px;display:inline"></p>
	              <div id="protolikesbox" style="display: none;">
					
				  </div>
	              <div id="protocommentbox" style="display: none">
	              
				  </div>

	            </div>
	            
	            <div class="card-action" style="padding-top: 0px;padding-bottom: 0px">
		            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
		              <div class="col s2 m1" style="padding-top: 12px">
		                
						<a class="likebutton" href="#" value=""><i class="material-icons" style="font-size:32px"></i></a>
		              </div>
		              <div class="col s8 m10">
		                <input  data-id="" id="protocommentinput" type="text" class="comment_input" placeholder="write a comment :)">
		              </div>
		              
		              <div class="col s2 m1" style="padding-top: 10px">
		                <button data-id="" class="comment_button btn-floating right " id="protocommentbutton"><i class="fa fa-send" style="font-size: 16px"></i></button>
		              </div>
		            </div>
	            </div>
</div>

	        <button class="btn-floating right delButton" id="protodelbutton" value="" style="display: none;"><i class="fa fa-trash" style="font-size: 16px; "></i></button>

<div class="container">
	@yield('content')
</div>


<div id="chat-slide-out"  class="side-nav">
    <div class="row card blue valign-wrapper" style="padding-top: 0px;margin: auto;height: 10%;">
    	<div class="col s12 center-align">
    		<span class="white-text card-title">Chatbox</span>
    	</div>
        </div>
      <div id="scroll-chat" class="scrollbar" style="height: 80%">
        <div id="chatbox" class="scrollbox-content " style="padding-top: 5px;padding-left: 5px">
        	<?php $msgid=-1; ?>
        	@foreach($chats as $chat)
				@if((Auth::user()->id)==($chat->user->id))
					<div class="row" style="margin-bottom:5px">
		              <div class="right rightmsg ">{{$chat->message}}<p class="chattime">{{date("h:i",strtotime($chat->created_at))}}</p></div>
		            </div>
				@else
					<div class="row" style="margin-bottom:5px">
		              <div class="leftmsg left"><p class="chatinfo">{{$chat->user->username}} | {{date("h:i",strtotime($chat->created_at))}}</p>{{$chat->message}}</div>
		            </div>
				@endif	
				<?php $msgid=$chat->id; ?>
			@endforeach
        </div>
      </div>
        <div class="row valign-wrapper" style="margin: auto;height: 10%">
          <div class="col s2 m2" style="padding-top: 20px;padding-right: 0px">
                <a style="padding: 0px" onclick="hideChatBox();"><i style="font-size: 32px" class="material-icons">reply</i></a>
              </div>
              <div class="col s8 m8" style="padding-left: 0px;padding-right: 0px">
                <input style="margin-bottom: 0px;" onkeydown = "if (event.keyCode == 13) sendMessage();" type="text" name="text" id="message" placeholder="Enter your message :)">
              </div>
              <div class="col s2 m2" style="padding-top: 20px">
              	<a style="padding: 0px" id="sendbutton" onclick="sendMessage();"><i id="sendIcon" class="material-icons" style="font-size: 32px">send</i></a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script type="text/javascript" src="js/buttons.js"></script>
   <script type="text/javascript" src="js/chatbox.js"></script>
   <script type="text/javascript" src="js/myjs.js"></script>
   <script src="https://use.fontawesome.com/13ed732878.js"></script>

@yield('JSwithTags')


<script type="text/javascript">
var x={{$msgid}};
var auth_id={{Auth::id()}};

@yield('jscript')

$(document).ready(function(){
      $('.slider').slider({full_width: true});
      $('.slider').height('230');
      $('.slides').height('200');
    });

$(document).ready(function(){
    $('#post').attr('disabled',true);

    $('#mytext').keyup(function(){
        if($(this).val().length !=0){
            $('#post').attr('disabled', false);
        }
        else
        {
            $('#post').attr('disabled', true);        
        }
    })
});

function hideChatBox() {
	$('.button-collapse').sideNav('hide');
}

</script>
</html>