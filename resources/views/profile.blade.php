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
				<p>{{count($posts)}} Posts | {{$user->likes()->count()}} Likes | {{$user->comments()->count()}} Comments</p>
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
		        <li class="tab col s4"><a style="font-size: 12px" href="#test1">My Posts</a></li>
		        <li class="tab col s4"><a style="font-size: 12px" href="#test2">My Likes</a></li>
		        <li class="tab col s4"><a style="font-size: 12px" href="#test3">My Activity</a></li>
		      </ul>
		    </div>
		    <div class="col s12" id="test1">
				@foreach($posts as $post)
				<div class="card feed z-depth-4">
					@if($post->path!=NULL)
					<div class="card-image">
		              <img src="{{$post->path}}">
		            </div>
		            @endif
		            <div class="card-content" style="padding: 10px 10px 5px 10px;">
		              <div class="row" style="margin-bottom: 10px">
			              <div class="col s2 m1">
			                <img src="{{$post->user->displaypic}}" class="circle left" width="35" height="35">
			              </div>
			              <div class="col s8 m10">
			                <p>By <strong>{{$post->user->username}}</strong></p>
			                <p style="font-size: 10px"><strong>{{date("j M | D H:i",strtotime($post->created_at))}}</strong></p>
			              </div>
			              <div class="col s2 m1">
			              @if ($post->user_id==$user->id)

			                <button class="btn-floating right delButton" id="delButton" value="{{$post->id}}" ><i id="{{$post->id}}delspinner" class="fa fa-trash" style="font-size: 16px"></i></button>
			               @endif
			              </div>
		            </div>
		              <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($post->data)!!}
	              </blockquote>
		              <a id="{{$post->id}}likes" data-id="{{$post->id}}" class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;">{{$post->likes()->count()}} Likes</a>
		              <a id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline">{{$post->comments()->count()}} Comments</a>
					  <i style="display: none;" id="{{$post->id}}spinner" class="fa fa-spinner fa-pulse"></i>	              

		              <div id="{{$post->id}}likesbox" style="display: none;">
						
					  </div>
		              <div id="{{$post->id}}commentbox" style="display: none">
		              
					  </div>

		            </div>
		            <div class="card-action" style="padding: 0px 10px 0px 10px;">
			            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="cursor: pointer;margin-right: 0px;" class="likebutton left" value="{{$post->id}}">
								<i class="material-icons" style="font-size:32px">@if($likes->contains('post_id',$post->id)) favorite @else favorite_border @endif</i>
							</a>
			              </div>
			              <div class="col s8 m10">
			                <input style="margin-bottom: 10px" data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
			              </div>
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="margin-right: 0px;cursor: pointer;" data-id="{{$post->id}}" class="comment_button right" id="{{$post->id}}commentbutton"><i style="font-size: 32px" class="material-icons">send</i></a>
			              	<div id="{{$post->id}}commentspinner" class="hide preloader-wrapper small right">
							    <div class="spinner-layer spinner-red-only">
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
		        @endforeach
			</div>
		    <div id="test2" class="col s12">
		    	@foreach($likedposts as $likedpost)
				<div class="card feed z-depth-4">
					@if($likedpost->path!=NULL)
					<div class="card-image">
		              <img src="{{$likedpost->path}}">
		            </div>
		            @endif
		            <div class="card-content" style="padding: 10px 10px 5px 10px;">
		              <div class="row" style="margin-bottom: 10px">
			              <div class="col s2 m1">
			                <img src="{{$likedpost->user->displaypic}}" class="circle left" width="35" height="35">
			              </div>
			              <div class="col s8 m10">
			                <p>By <strong>{{$likedpost->user->username}}</strong></p>
			                <p style="font-size: 10px"><strong>{{date("j M | D H:i",strtotime($likedpost->created_at))}}</strong></p>
			              </div>
			              <div class="col s2 m1">
			              @if ($likedpost->user_id==$user->id)
			                <button class="btn-floating right delButton waves-effect waves-light" id="delButton" value="{{$likedpost->id}}" ><i id="{{$likedpost->id}}delspinner" class="fa fa-trash" style="font-size: 16px"></i></button>
			               @endif
			              </div>
		            </div>
		              <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($likedpost->data)!!}
	              </blockquote>
		              <a id="{{$likedpost->id}}likes" data-id="{{$likedpost->id}}" class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;">{{$likedpost->likes()->count()}} Likes</a>
		              <a id="{{$likedpost->id}}comments" data-id="{{$likedpost->id}}" class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline">{{$likedpost->comments()->count()}} Comments</a>
					  <i style="display: none;" id="{{$likedpost->id}}spinner" class="fa fa-spinner fa-pulse"></i>	              

		              <div id="{{$likedpost->id}}likesbox" style="display: none;">
						
					  </div>
		              <div id="{{$likedpost->id}}commentbox" style="display: none">
		              
					  </div>

		            </div>
		            <div class="card-action" style="padding: 0px 10px 0px 10px;">
			            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="cursor: pointer;margin-right: 0px;" class="likebutton left" value="{{$likedpost->id}}">
								<i class="material-icons" style="font-size:32px">@if($likes->contains('post_id',$likedpost->id)) favorite @else favorite_border @endif</i>
							</a>
			              </div>
			              <div class="col s8 m10">
			                <input style="margin-bottom: 10px" data-id="{{$likedpost->id}}" id="{{$likedpost->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
			              </div>
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="margin-right: 0px;cursor: pointer;" data-id="{{$likedpost->id}}" class="comment_button right" id="{{$likedpost->id}}commentbutton"><i style="font-size: 32px" class="material-icons">send</i></a>
			              	<div id="{{$likedpost->id}}commentspinner" class="hide preloader-wrapper small right">
						    <div class="spinner-layer spinner-red-only">
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
		        @endforeach
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
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
});

function pic_error()
{
	$("#profile-pic").attr("src","profile_pic/default.png")
}

@endsection