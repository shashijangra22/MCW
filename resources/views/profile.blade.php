@extends('home1main')

@section('content')
<?php 
	function yr($value)
	{
		switch ($value) 
			{
				case '1':
					return "I";
					break;
				
				case '2':
					return "II";
					break;
				
				case '3':
					return "III";
					break;
				
				case '4':
					return "IV";
					break;
			}
	}
	function dpmt($value)
	{
		switch ($value) 
			{
				case '1':
					return "CS";
					break;
				
				case '2':
					return "BMS";
					break;
				
				case '3':
					return "Instru";
					break;
				
				case '4':
					return "Physics";
					break;
				case '5':
					return "Poly";
					break;
				
				case '2':
					return "Micro";
					break;
				
				case '3':
					return "FT";
					break;
				
				case '4':
					return "Electro";
					break;
			}	
	}
	function myposts($value)
	{
		return ($value==null)?0:$value->count();
	}
?>

	

<div class="row">
<div class="col m12 s12 l3 offset-l1">

	<div class="card z-depth-4">
		<div class="card-content blue white-text" style="text-align: center;padding-top: 5px;padding-bottom: 5px">
	      <span class="card-title">{{$user->username}}</span>
	     </div>
	     <div class="card-image" id="profile_img">
	     	<a href="#" onclick="upload();"><img src="{{$user->displaypic}}" id="profile-pic" class="profile-pic"></a>
	     	<form id="pic-form" role="form" enctype="multipart/form-data" action="#">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="file" accept="image/*" class="hide" name="pic" id="pic"/>
			</form>
	     </div>
	     <div class="card-content" style="text-align: center;font-weight: 500">
	     	@if ($user->gender==1)
				<p>{{$user->fname}} {{$user->lname}} <i class="fa fa-mars"></i></p>
			@else
				<p>{{$user->fname}} {{$user->lname}} <i class="fa fa-venus"></i></p>
			@endif
			<p>{{$user->email}}</p>
			<p>{{dpmt($user->department)}} | {{yr($user->year)}} | {{myposts($user->posts)}} Posts</p>
			<p>A litle bit of everything :D :D :D</p>
	     </div>
	</div>

	<ul class="card collapsible z-depth-4" data-collapsible="accordion">
	    <li>
	      <div class="collapsible-header card-content" style="text-align: center;padding-top: 5px;padding-bottom: 5px"><span class="card-title">Edit Profile</span></div>
	      <div class="collapsible-body card-action">
		      <form id="edit-form" role="form" enctype="multipart/form-data">
			      <label for="fname">First Name</label>
			      <input id="fname" name="fname" type="text" value="{{$user->fname}}">
			      <label for="lname">Last Name</label>	
			      <input id="lname" name="lname" type="text" value="{{$user->lname}}">
			      <label for="username">Username</label>	
			      <input id="username" name="username" type="text" value="{{$user->username}}">
			      <label for="bio">Bio</label>	
			      <input id="bio" name="bio" type="text" value="A little bit of everything :D">
			      <button id="editBtn" name="editBtn" class="btn">Submit</button>
	      	</form>
	      </div>
	    </li>
  	</ul>

	<!-- <ul class="card collapsible z-depth-4" data-collapsible="accordion">
	 	<li>
	      <div class="collapsible-header card-content" style="text-align: center;padding-top: 5px;padding-bottom: 5px"><span class="card-title">Change Password</span></div>
	      <div class="collapsible-body card-action">
	      <form id="password-form" role="form" enctype="multipart/form-data">
		      <label for="current_password">Current Password</label>
		      <input id="current_password" name="current_password" type="password">
		      <label for="new_password">New Password</label>
		      <input id="new_password" name="new_password" type="password">
		      <label for="new2_password">Re-enter New Password</label>
		      <input id="new2_password" name="new2_password" type="password">
		      <button id="editPassBtn" name="editPassBtn" class="btn">Submit</button>
	      </form>
	      </div>
	    </li>
	</ul> -->
          
	
</div>
	<div class="col m12 s12 l7">
	     <div class="card row z-depth-4">
		      <ul class="tabs blue">
		        <li class="tab col s6"><a class="white-text" href="#test1">My Posts</a></li>
		        <li class="tab col s6"><a class="white-text" href="#test2">My Liked Posts</a></li>
		      </ul>
	      </div>
	      <div class="row">
	      	<div id="test1">
	      		{{--*/$postflag=0/*--}}
			{{--*/$postid=-1/*--}}
			{{--*/$post_id=-1/*--}}
			@foreach($posts as $post)

			@if($postflag==0)
			{{--*/$postid=$post->id/*--}}
			{{--*/$postflag=1/*--}}
			@endif
			{{--*/$post_id=$post->id/*--}}
			<div class="card sticky-action feed z-depth-4">
				@if($post->path!=NULL)
				<div class="card-image">
	              <img class="materialboxed" src="{{$post->path}}">
	            </div>
	            @endif
	            <div class="card-content primary-color white-text" style="padding-top: 10px;padding-bottom: 10px">
	              <div class="row" style="padding-top: 5px">
		              <div class="col s2 m1">
		                <img src="{{$post->user->displaypic}}" class="circle left" width="35" height="35">
		              </div>
		              <div class="col s8 m10">
		                <p>By <strong>{{$post->user->username}}</strong></p>
		                <p style="font-size: 10px"><strong>{{$post->created_at}}</strong></p>
		              </div>
		              <div class="col s2 m1">
		              @if ($post->user_id==$user->id)
		                <button class="btn-floating right delButton accent-color" id="delButton" value="{{$post->id}}" ><i class="fa fa-trash" style="font-size: 16px"></i></button>
		               @endif
		              </div>
	            </div>
	              <p style="text-align: justify;padding-bottom: 5px">
	              		{!!nl2br($post->data)!!}
	              </p>
	              <p id="{{$post->id}}likes" class="chip secondary-color activator likescount" style="padding: 6px;display: inline; color:#c51162">{{$post->likes()->count()}} Likes</p>
	              <p id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip secondary-color activator commentscount" style="padding: 6px;color:#c51162;display:inline">{{$post->comments()->count()}} Comments</p>

	            </div>
	            <div class="card-action secondary-color" style="padding-top: 5px;padding-bottom: 0px; ">
		            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
		              <div class="col s2 m1" style="padding-top: 12px">
		                @if($likes->contains('post_id',$post->id))
						<a class="likebutton " href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite</i></a>	
						@else
						<a class="likebutton" href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite_border</i></a>
						@endif
		              </div>
		              <div class="col s8 m10">
		                <input  data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
		              </div>
		              <div class="col s2 m1" style="padding-top: 12px">
		                <button data-id="{{$post->id}}" class="comment_button btn-floating right accent-color" ><i class="fa fa-send" style="font-size: 16px"></i></button>
		              </div>
		            </div>
	            </div>
	            <div class="card-reveal secondary-color" style="padding-top: 0px">
			      
			      <div class="row">
				    <div class="col s8">
				      <ul class="tabs ">
				        <li class="tab col s6 commentcount accent-color white-text"><a class="" href="#{{$post->id}}commentbox" ">{{$post->comments()->count()}} Comments</a></li>
				        <li class="tab col s6 likecount accent-color white-text"><a href="{{$post->id}}likebox" ">{{$post->likes()->count()}} Likes</a></li>
				      </ul>
				    </div>
				    <div class="col s4">
				    	<span class="card-title" style="padding-top: 10px"><i class="material-icons right">close</i></span>
				    </div>
				    <div id="{{$post->id}}likebox" class="col s12 " style="padding-top: 10px">
				    </div>
				    <div id="{{$post->id}}commentbox" class="col s12 " style="padding-top: 10px">
					    	
				
				    </div>
				  </div>
			    </div>
	        </div>
	        @endforeach
	      	</div>
	      	<div id="test2">
	      		Test2
	      	</div>
	      </div>
	</div>
</div>
@endsection

@section('jscript')

function upload() 
{
    $("input[id='pic']").click();
}

$('#editBtn').on("click",function(e){
			e.preventDefault();
			var formData = new FormData($("#edit-form")[0]);
		$.ajax({
			url: "updateProfile",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
			if(result==0)
				alert('Data edited');
			else
				alert(result);
			});
		
			
		});

  $('#pic').change(function(e) 
	{
			e.preventDefault();
			var id={{$user->id}};
			var formData = new FormData($("#pic-form")[0]);

		$.ajax({
			url: "updatepic/"+id,
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		if(result==0)
			$("#profile_img").load(window.location + " #profile-pic");		
			});
		});


$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".profileBtn").addClass('active');
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
});

function pic_error()
{
	$("#profile-pic").attr("src","profile_pic/default.png")
}

@endsection