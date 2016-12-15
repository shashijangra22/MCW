@extends('home1main')

@section('content')
<div class="row" style="margin-bottom: 0px">
	<div class="col m12 s12 l3 offset-l1" style="padding-left: 5px;padding-right: 5px">
		<div class="card">
			<div class="card-content" style="text-align: center;">
					<a style="cursor: pointer;" onclick="upload();"><img src="{{$user->displaypic}}" id="profile-pic" class="z-depth-4 circle responsive-img profile-pic"></a>
			     	<form id="pic-form" role="form" enctype="multipart/form-data" action="#">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="file" accept="image/*" class="hide" name="pic" id="pic"/>
					</form>
				<p><strong style="font-size: 20px">{{$user->fname}} {{$user->lname}}</strong></p>
				<p>{{$user->posts()->count()}} Posts | {{$user->likes()->count()}} Likes | {{$user->comments()->count()}} Comments</p>
				<p>{{$user->email}}</p>
			</div>
		</div>

		<ul class="card collapsible" data-collapsible="accordion">
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
				      <button id="editBtn" name="editBtn" class="btn">Submit</button>
		      	</form>
		      </div>
		    </li>
	  	</ul>
	</div>
	<div class="col m12 s12 l7">
		<div class="row" style="margin-bottom: 0px">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s6"><a style="font-size: 12px" href="#postsRow">My Posts</a></li>
		        <li class="tab col s6"><a style="font-size: 12px" href="#test3">My Activity</a></li>
		      </ul>
		    </div>
		    <div class="col s12" id="postsRow">
				
			</div>
		    <div id="test3" class="col s12">
		    	<div class="card z-depth-4">
					<div class="card-content">
						<span class="card-title" style="font-size: 20px">Recent activity</span>
						@foreach ($myActivities as $activity)
						<?php 
					    	$postedon=$activity->post->user->username;
					    	if ($postedon==$user->username) {
					    		$postedon='your own';
					    	}
					    	else
					    		$postedon=$postedon . "'s";
					    	?>
							<blockquote style="font-size: 12px;margin: 10px 0px 0px 0px">
					    		@if ($activity->type==0)
					    			You <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
					    		@elseif ($activity->type==1)
				    				You liked {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
					    		@else
				    				You commented on {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
					    		@endif
					    		<p class="right" style="margin-top: 0px;margin-bottom: 0px;display: inline;font-size: 10px">{{date("j M | H:i",strtotime($activity->created_at))}}</p>
					    	</blockquote>
						@endforeach
					</div>
				</div>
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
				Materialize.toast(result,3000);
			});
		});

  $('#pic').change(function(e) 
	{
			$('.spinner-wrapper').fadeIn('slow');
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
			Materialize.toast(result,3000);
			$('.spinner-wrapper').fadeOut('slow');
			});
		});


$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".profileBtn").addClass('active');
	profileModule.myProfilePosts();
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
});

@endsection